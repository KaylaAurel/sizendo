<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    public function showForm(Request $request)
    {
        $paket = $request->query('paket');
        $harga = $request->query('harga');

        if (!in_array($paket, ['Netizen', 'Aktivis', 'Inisiator']) || !is_numeric($harga)) {
            abort(404);
        }

        return view('payment', compact('paket', 'harga'));
    }

    public function getToken(Request $request, MidtransService $midtransService)
    {
        $validated = $request->validate([
            'paket'   => 'required|string|in:Netizen,Aktivis,Inisiator',
            'total'   => 'required|numeric|min:1000',
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'sosmed'  => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:500',
        ]);

        $orderId = uniqid('order-');

        $itemDetails = [[
            'id'       => $orderId,
            'price'    => (int) $validated['total'],
            'quantity' => 1,
            'name'     => $validated['paket'] . ' Membership',
        ]];

        $customerDetails = [
            'first_name' => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
        ];

        $snapToken = $midtransService->createTransaction($orderId, $validated['total'], $itemDetails, $customerDetails);

        return response()->json(['token' => $snapToken]);
    }
}