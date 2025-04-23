<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Config;

class MidtransService
{
    public function __construct()
    {
        // Set Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction($orderId, $amount, $itemDetails, $customerDetails)
    {
        // Create transaction data for Midtrans
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $amount,
        ];

        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            // Get snap token
            return Snap::getSnapToken($transactionData);
        } catch (\Exception $e) {
            throw new \Exception('Pembayaran gagal: ' . $e->getMessage());
        }
    }
}
