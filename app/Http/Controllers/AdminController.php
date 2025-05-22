<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Menampilkan dashboard dengan daftar member dan paket
   public function dashboard()
{
    if (!session('admin')) {
        return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $members = Member::orderBy('created_at', 'desc')->get();
    $pakets = Paket::orderBy('created_at', 'desc')->get();

    return view('admin.dashboard', compact('members', 'pakets'));
}


    // Aktivasi member
    public function activateMember($id)
    {
        $member = Member::findOrFail($id);
        $member->is_active = true;
        $member->start_date = Carbon::now();
        $member->end_date = Carbon::now()->addMonths(12); // 1 tahun aktif
        $member->save();

        // Kirim notifikasi WhatsApp
        $this->sendWhatsappNotification($member);

        return redirect()->back()->with('success', 'Member berhasil diaktifkan dan notifikasi terkirim.');
    }

    // Nonaktifkan member
    public function deactivateMember($id)
    {
        $member = Member::find($id);

        if ($member) {
            $member->is_active = false;
            $member->save();

            return redirect()->back()->with('success', 'Member berhasil dinonaktifkan.');
        }

        return redirect()->back()->with('error', 'Member tidak ditemukan.');
    }

    // Kirim notifikasi WA ke member yang diaktifkan
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
                   "Silahkan lanjutkan download Sizendo App untuk mendapatkan layanan anda!\n" .
                   "Terima kasih telah bergabung bersama kami!";

        Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
        ]);
    }


    // Halaman edit paket
    public function editPaket($id)
    {
        $paket = Paket::findOrFail($id);

        return view('admin.paket.edit', compact('paket'));
    }

    // Update paket
    public function updatePaket(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Paket berhasil diperbarui.');
    }
}
