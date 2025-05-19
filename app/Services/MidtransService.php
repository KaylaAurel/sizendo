<?php

namespace App\Services;

use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;  // <-- Laravel Config

class MidtransService
{
    public function __construct()
    {
        // Ambil langsung dari config/midtrans.php (yang sudah baca .env sebelum dicache)
        MidtransConfig::$serverKey    = Config::get('midtrans.server_key');
        MidtransConfig::$clientKey    = Config::get('midtrans.client_key');
        MidtransConfig::$isProduction = Config::get('midtrans.is_production');
        MidtransConfig::$isSanitized  = true;
        MidtransConfig::$is3ds        = true;
    }

    public function createTransaction(string $orderId, float|int $grossAmount, array $itemDetails, array $customerDetails): string
    {
        $transaction = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $grossAmount,
            ],
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapResponse = Snap::createTransaction($transaction);

            if (empty($snapResponse->token)) {
                throw new Exception('Failed to retrieve Snap token.');
            }

            return $snapResponse->token;
        } catch (Exception $e) {
            Log::error('MidtransService Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw new Exception('Error creating transaction: ' . $e->getMessage());
        }
    }
}