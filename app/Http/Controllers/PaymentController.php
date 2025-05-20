<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MidtransService;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Midtrans\Notification as MidtransNotification;

class PaymentController extends Controller
{
    /**
     * Tampilkan form pembayaran berdasarkan paket dan harga
     */
    public function showForm(Request $request)
    {
        $paket = $request->query('paket');
        $harga = $request->query('harga');

        if (!in_array($paket, ['Netizen', 'Aktivis', 'Inisiator']) || !is_numeric($harga)) {
            abort(404);
        }

        return view('payment', compact('paket', 'harga'));
    }

    /**
     * Simpan data member, generate Midtrans Snap token, dan kembalikan token ke client
     */
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

        DB::beginTransaction();
        try {
            // 1) Simpan data member dengan status pending
            $member = Member::create([
                'order_id'    => $orderId,
                'nama_member' => $validated['name'],
                'email'       => $validated['email'],
                'paket'       => $validated['paket'],
                'total'       => $validated['total'],
                'no_wa'       => $validated['phone'],
                'sosmed'      => $validated['sosmed'],
                'catatan'     => $validated['catatan'],
                'status'      => 'pending',
            ]);

            // 2) Prepare item and customer details
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

            // 3) Generate Snap token
            $snapToken = $midtransService->createTransaction(
                $orderId,
                $validated['total'],
                $itemDetails,
                $customerDetails
            );

            DB::commit();
            return response()->json(['token' => $snapToken]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error saving member & generating token', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Gagal memproses transaksi, silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Handler webhook Midtrans untuk update status pembayaran
     */
    public function notificationHandler(Request $request)
    {
        $notif = new MidtransNotification();

        $orderId = $notif->order_id;
        $status  = $notif->transaction_status;

        $member = Member::where('order_id', $orderId)->first();
        if (! $member) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Mapping status Midtrans ke kolom status
        switch ($status) {
            case 'capture':
            case 'settlement':
                $member->status = 'paid';
                break;
            case 'deny':
            case 'cancel':
            case 'expire':
                $member->status = 'failed';
                break;
            case 'pending':
                $member->status = 'pending';
                break;
        }
        $member->save();

        return response()->json(['message' => 'OK']);
    }
}