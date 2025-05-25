<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash; // untuk hash password
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = DB::table('admins')
            ->where('email', $request->email)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->regenerate();
            
            $request->session()->put('admin_data', $admin); // data admin
            
            return redirect()->intended(route('admin.dashboard'));
        }


        return back()->withErrors(['message' => 'Email atau password salah'])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::table('admins')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect(route('admin.login'))->with('success', 'Admin berhasil terdaftar!');
    }

    public function dashboard(Request $request)
    {
        $members = Member::orderBy('created_at', 'desc')->get();

    $paket = null;
    if ($request->has('paket_id')) {
        $paket = Paket::find($request->paket_id);
    }

    // Ambil data jumlah member per bulan
    $chartData = Member::select(
        DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan"),
        DB::raw("COUNT(*) as total")
    )
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->get();

    return view('admin.dashboard', [
        'members' => $members,
        'paket' => $paket,
        'chartData' => $chartData,
    ]);

    }

    // Method activateMember sesuai permintaanmu
    public function activateMember($id)
    {
        $member = Member::findOrFail($id);
        $member->is_active = true;
        $member->start_date = Carbon::now(); // Mulai aktif sekarang
        $member->end_date = Carbon::now()->addMonths(12); // Durasi langganan 1 tahun
        $member->save();

        // Kirim notifikasi WA
        $this->sendWhatsappNotification($member);

        return redirect()->back()->with('success', 'Member berhasil diaktifkan dan pemberitahuan telah dikirim.');
    }

    public function deactivateMember($id)
    {
        $member = Member::find($id);

        if ($member) {
            $member->update([
                'is_active' => false,
            ]);

            return redirect()->back()->with('success', 'Member berhasil dinonaktifkan.');
        }

        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    private function sendWhatsappNotification($member)
    {
        $phone = preg_replace('/[^0-9]/', '', $member->no_wa);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = "Halo *{$member->nama_member}*,\n" .
                   "Langganan Anda telah diaktifkan selama *1 tahun*.\n" .
                   "Paket: *{$member->paket}*\n" .
                   "Berlaku sampai: *" . Carbon::parse($member->end_date)->format('d-m-Y') . "*\n\n" .
                   "Silahkan lanjutkan download Sizendo App untuk mendapatkan layanan anda!".
                   "Terima kasih telah bergabung bersama kami!";

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
        ]);
    }
}
