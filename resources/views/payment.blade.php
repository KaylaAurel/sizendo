<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Silakan Lakukan Pembayaran</h1>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert('Pembayaran berhasil!');
                    // Arahkan ke halaman sukses atau simpan data transaksi
                },
                onPending: function(result){
                    alert('Pembayaran tertunda.');
                },
                onError: function(result){
                    alert('Pembayaran gagal.');
                }
            });
        }
    </script>
</body>
</html>
