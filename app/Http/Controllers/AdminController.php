<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
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
