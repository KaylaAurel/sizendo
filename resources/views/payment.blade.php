<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pembayaran Paket {{ $paket }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 20px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Pembayaran Paket {{ $paket }}</h1>
    <form id="paymentForm">
        @csrf
        <div>
            <label>Paket</label>
            <input type="text" name="paket_display" value="{{ $paket }}" readonly>
            <input type="hidden" name="paket" value="{{ $paket }}">
        </div>
        <div>
            <label>Harga (Rp)</label>
            <input type="text" value="Rp {{ number_format($harga,0,',','.') }}" readonly>
            <input type="hidden" name="total" value="{{ $harga }}">
        </div>
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Nomor HP / WhatsApp</label>
            <input type="text" name="phone" required>
        </div>
        <div>
            <label>Sosial Media (Opsional)</label>
            <input type="text" name="sosmed">
        </div>
        <div>
            <label>Catatan (Opsional)</label>
            <textarea name="catatan" rows="3"></textarea>
        </div>
        <button type="submit" id="pay-button">Bayar Sekarang</button>
    </form>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

    <script>
    document.getElementById('paymentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = {
            paket: form.paket.value,
            total: parseInt(form.total.value, 10),
            name: form.name.value.trim(),
            email: form.email.value.trim(),
            phone: form.phone.value.trim(),
            sosmed: form.sosmed.value.trim(),
            catatan: form.catatan.value.trim(),
        };

        try {
            const response = await fetch("{{ route('payment.token') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.message || 'Terjadi kesalahan.');
            }

            const { token } = await response.json();

            window.snap.pay(token, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    alert('Pembayaran berhasil!');
                    window.location.href = "/";
                },
                onError: function(err) {
                    console.error('Payment error:', err);
                    alert('Pembayaran gagal.');
                },
                onClose: function() {
                    alert('Popup pembayaran ditutup.');
                }
            });
        } catch (err) {
            console.error('Error:', err);
            alert('Gagal memproses transaksi: ' + err.message);
        }
    });
    </script>
</body>
</html>