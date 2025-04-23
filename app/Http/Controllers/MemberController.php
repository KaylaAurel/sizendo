<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Services\MidtransService;

class MemberController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_member' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'paket' => 'required|string|max:255',
            'no_wa' => 'required|string|max:15',
            'sosmed' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Simpan data member
        $member = Member::create($validated);

        // Buat transaksi dengan Midtrans
$orderId = 'ORDER-' . $member->id;
$grossAmount = 100000;

$itemDetails = [
    [
        'id' => $member->id,
        'price' => $grossAmount,
        'quantity' => 1,
        'name' => 'Paket ' . $member->paket,
    ]
];

$customerDetails = [
    'first_name' => $request->nama_member,
    'email' => $request->email,
    'phone' => $request->no_wa,
];

$snapToken = $this->midtransService->createTransaction($orderId, $grossAmount, $itemDetails, $customerDetails);


        // Jika transaksi berhasil, arahkan ke halaman pembayaran
        if ($snapToken) {
            return view('payment', compact('snapToken'));
        } else {
            return redirect()->back()->withErrors('Gagal membuat transaksi.');
        }
    }
}
