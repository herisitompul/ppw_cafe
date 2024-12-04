<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .container-header {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .order-header .status {
            display: flex;
            gap: 10px;
        }

        .status span {
            background-color: #ffeb3b;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .order-details {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-item img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }

        .order-item-details {
            flex-grow: 1;
            margin-left: 20px;
        }

        .order-item-details a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .order-item-details p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .order-item-price {
            font-size: 16px;
        }

        .order-actions {
            display: flex;
            justify-content: space-between;
        }

        .order-actions button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .order-summary {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
        }

        .order-summary .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .summary-header .status {
            background-color: #ffeb3b;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .summary-details {
            margin-bottom: 20px;
        }

        .summary-details p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 14px;
        }

        .summary-details p span {
            color: #666;
        }

        .summary-total {
            font-size: 16px;
            font-weight: bold;
        }

        .summary-actions {
            display: flex;
            justify-content: end;
        }

        .summary-actions button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .summary-actions .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 10px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    @include('user.layout.header')

    <div class="container-header mt-5">
        <div class="order-header">
            <h1>#{{ $order->order_number }}</h1>
            @if ($order->status == 'pending')
                <div class="status">
                    <span>Payment pending</span>
                </div>
            @endif
        </div>
        <p>{{ $order->created_at }}</p>
        <div class="order-details">
            @foreach ($orderItems as $orderItem)
                <div class="order-item">
                    <img src="{{ asset('gambar/' . $orderItem->produk->gambar) }}" alt="Product image">
                    <div class="order-item-details">
                        <a href="#">{{ $orderItem->produk->judul }}</a>
                        <p>{{ $orderItem->produk->kategori->nama }}</p>
                    </div>
                    <div class="order-item-price">Rp {{ number_format($orderItem->harga) }} ×
                        {{ $orderItem->kuantitas }} = Rp {{ number_format($orderItem->harga * $orderItem->kuantitas) }}
                    </div>
                </div>
            @endforeach

        </div>
        <div class="order-summary">
            <div class="summary-header">
                <div class="status">{{ $order->status }}</div>
            </div>
            <div class="summary-details">
                <p class="summary-total"><span>Total</span> <span>Rp {{ number_format($order->total_price) }}</span>
                </p>
                <p><span>Pembayaran</span> <span>Rp {{ number_format($order->total_price) }}</span></p>
            </div>
            <div class="summary-actions">
                <button id="pay-now">Bayar Sekarang</button>
            </div>

        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.querySelector('button').addEventListener('click', function() {
            const orderId = '{{ $order->id }}';

            // Log untuk memeriksa apakah tombol ditekan
            console.log('Button clicked, order ID:', orderId);

            fetch('{{ route('pay.now') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    order_id: orderId
                }),
            })
            .then(response => {
                // Log untuk memeriksa respons dari server
                console.log('Response from server:', response);
                return response.json();
            })
            .then(data => {
                if (data.token) {
                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            Swal.fire('Success', 'Pembayaran berhasil!', 'success');
                            window.location.href = '/order/success';
                        },
                        onPending: function(result) {
                            Swal.fire('Pending', 'Menunggu pembayaran...', 'info');
                        },
                        onError: function(result) {
                            Swal.fire('Error', 'Pembayaran gagal!', 'error');
                        }
                    });
                } else {
                    // Log jika tidak ada token
                    console.error('No token received:', data);
                    Swal.fire('Error', 'Gagal mendapatkan token pembayaran!', 'error');
                }
            })
            .catch(error => {
                // Log untuk menangani error
                console.error('Error during fetch:', error);
                Swal.fire('Error', 'Terjadi kesalahan saat menghubungi server!', 'error');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
