<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function store(Request $request)
    {
        // Validasi form pendaftaran
        $validated = $request->validate([
            'nama_member' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'paket' => 'required|string',
            'no_wa' => 'required|string',
            'sosmed' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Simpan data member ke tabel members
        $member = Member::create($validated);

        // Hitung harga berdasarkan jenis paket
        $harga = match ($validated['paket']) {
            'Netizen' => 25000,
            'Aktivis' => 75000,
            'Inisiator' => 150000,
            default => 0,
        };

        // Buat Order ID unik
        $orderId = 'ORDER-' . strtoupper(Str::random(10));

        // Siapkan item untuk pembayaran Midtrans
        $itemDetails = [[
            'id' => strtolower($validated['paket']),
            'price' => $harga,
            'quantity' => 1,
            'name' => 'Paket ' . $validated['paket']
        ]];

        // Informasi pelanggan
        $customerDetails = [
            'first_name' => $validated['nama_member'],
            'email' => $validated['email'],
            'phone' => $validated['no_wa'],
        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = $this->midtransService->createTransaction($orderId, $harga, $itemDetails, $customerDetails);

        // Simpan transaksi ke tabel transactions
        Transaction::create([
            'member_id' => $member->id,
            'order_id' => $orderId,
            'paket' => $validated['paket'],
            'amount' => $harga,
            'status' => 'pending',
            'snap_token' => $snapToken,
        ]);

        // Tampilkan halaman pembayaran dengan Snap Token Midtrans
        return view('member.payment', [
            'snapToken' => $snapToken,
            'nama' => $validated['nama_member'],
            'paket' => $validated['paket'],
            'harga' => $harga,
            'member_id' => $member->id // disimpan agar bisa dipakai untuk register user nanti
        ]);
    }

    // Setelah pembayaran sukses, redirect ke form pembuatan akun (login)
    public function paymentSuccess(Request $request)
    {
        $member_id = $request->query('member_id');

        // Pastikan transaksi sudah dibayar
        $transaction = Transaction::where('member_id', $member_id)->where('status', 'paid')->first();

        if (!$transaction) {
            return redirect()->route('payment.failed')->with('error', 'Transaksi belum selesai.');
        }

        // Redirect ke halaman register akun user
        return redirect()->route('register.member', ['member_id' => $member_id]);
    }

    // Jika gagal
    public function paymentFailed()
    {
        return view('member.payment-failed');
    }
}
