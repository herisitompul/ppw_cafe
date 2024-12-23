<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - DelCafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        /* Main content styling */
        .content {
            flex-grow: 1;
        }

        /* Footer styling */
        .footer {
            background-color: #7ca577;
            padding: 20px;
            /* text-align: center; */
            margin-top: auto;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    @include('user.layout.header')

    <div class="container mt-5">
        <h3 class="mb-4 mt-3">Berikan Ulasan</h3>

        @foreach ($order->orderItem as $orderItem)
            <div class="card mb-4 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('gambar/' . $orderItem->produk->gambar) }}" alt="Gambar Produk"
                            class="img-fluid rounded" style="max-width: 80%;">
                    </div>
                    <div class="col-md-10">
                        <div class="card-body">
                            <h5 class="card-title">{{ $orderItem->produk->judul }}</h5>
                            <p class="card-text text-muted">{{ $orderItem->produk->deskripsi }}</p>
                            <p class="card-text"><strong>Kategori:</strong> {{ $orderItem->produk->kategori->nama }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp
                                {{ number_format($orderItem->harga, 0, ',', '.') }}</p>

                            <form action="{{ route('order.review.store', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="rating-{{ $orderItem->id }}" class="form-label">Rating (1-5)</label>
                                    <select name="rating" id="rating-{{ $orderItem->id }}" class="form-select"
                                        required>
                                        <option value="">Pilih Rating</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="review-{{ $orderItem->id }}" class="form-label">Ulasan</label>
                                    <textarea name="review" id="review-{{ $orderItem->id }}" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</body>

</html>
