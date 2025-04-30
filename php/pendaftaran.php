<?php
require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';

// Set Midtrans config
\Midtrans\Config::$serverKey = 'SB-Mid-server-uwXRjovk2stoTYhaTGdbiUpF';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Dummy data untuk uji coba (bisa diganti dengan $_POST jika pakai form)
$transaction_details = [
    'order_id' => uniqid('order-'),
    'gross_amount' => 15000,
];
$customer_details = [
    'first_name' => 'Budi',
    'email' => 'budi@example.com',
    'phone' => '081234567890',
];

$params = [
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
];

$snapToken = \Midtrans\Snap::getSnapToken($params);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Midtrans</title>
</head>
<body>
    <h1>Silakan Lakukan Pembayaran</h1>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-c3_Hk-MH3LiTA6Th"></script>

    <script type="text/javascript">
        var snapToken = '<?= $snapToken ?>';

        document.getElementById('pay-button').onclick = function () {
            snap.pay(snapToken, {
                onSuccess: function(result){
                    alert('Pembayaran berhasil!');
                    console.log(result);
                },
                onPending: function(result){
                    alert('Pembayaran tertunda.');
                    console.log(result);
                },
                onError: function(result){
                    alert('Pembayaran gagal.');
                    console.log(result);
                },
                onClose: function(){
                    alert('Popup ditutup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
</body>
</html>
