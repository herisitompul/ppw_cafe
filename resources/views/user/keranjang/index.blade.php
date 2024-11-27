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

    <style>
        .booking-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .carditem {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .checkbox-custom {
            display: inline-block;
            margin-right: 10px;
        }

        .manage-remove {
            font-size: 0.9rem;
        }

        .subtotal-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @include('user.layout.header')

    <div class="container mt-5 mb-5">
        <div class="row w-100">
            <!-- Left Section -->
            <div class="col-md-8">
                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" class="form-check-input checkbox-custom" id="select-all">
                    <label for="select-all" class="form-label mb-0">All</label>
                </div>

                @foreach ($cartItem as $item)
                    <div class="booking-card align-items-start">
                        <input type="checkbox" class="form-check-input cart-status-checkbox me-3"
                            data-id="{{ $item->id }}" {{ $item->status == 'active' ? 'checked' : '' }}
                            data-initial-status="{{ $item->status }}"> <br>

                        <div class="carditem d-flex align-items-start">
                            <img src="{{ asset('gambar/' . $item->produk->gambar) }}" alt="{{ $item->produk->judul }}"
                                class="img-fluid" style="width: 100px; height: 70px;">
                            <div class="ms-3 flex-grow-1">
                                <h6>{{ $item->produk->judul }}</h6>
                                <p class="mb-1">{{ $item->produk->deskripsi }}</p>
                                <div class="d-flex align-items-center">
                                    <span>Stok: {{ $item->produk->stok }}</span>
                                    <div class="ms-3">
                                        <button class="btn btn-sm btn-outline-secondary quantity-decrease"
                                            data-item-id="{{ $item->id }}">-</button>
                                        <span class="quantity mx-2"
                                            data-item-id="{{ $item->id }}">{{ $item->kuantitas }}</span>
                                        <button class="btn btn-sm btn-outline-secondary quantity-increase"
                                            data-item-id="{{ $item->id }}">+</button>
                                    </div>
                                </div>
                                <p class="text-end fw-bold mt-2">Rp {{ number_format($item->produk->harga) }}</p>
                                <div class="d-flex justify-content-between manage-remove me-auto">
                                    <div class="d-flex justify-content-between manage-remove me-auto">
                                        <button class="text-white btn btn-sm btn-danger btn-remove-cart"
                                            data-item-id="{{ $item->id }}">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach




                <!-- Right Section -->
                <div class="col-md-12">
                    <div class="subtotal-card">
                        <div class="d-flex justify-content-between">
                            <span id="subtotal">Rp </span>
                        </div>
                        <button class="btn btn-orange w-100 mt-3" style="background-color: #ff6a00; color: white;">Beli
                            Sekarang</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('.quantity-increase').on('click', function() {
                    let quantitySpan = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantitySpan.text());
                    let itemId = $(this).data('item-id');

                    // Prevent quantity from exceeding stock
                    let stockElement = $(this).closest('.carditem').find('span:contains("Stok:")');
                    let stock = parseInt(stockElement.text().replace('Stok: ', ''));

                    if (currentQuantity < stock) {
                        updateQuantity(itemId, currentQuantity + 1, quantitySpan);
                    } else {
                        alert('Stok tidak mencukupi');
                    }
                });

                // Quantity decrease button
                $('.quantity-decrease').on('click', function() {
                    let quantitySpan = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantitySpan.text());
                    let itemId = $(this).data('item-id');

                    if (currentQuantity > 1) {
                        updateQuantity(itemId, currentQuantity - 1, quantitySpan);
                    }
                });

                // Function to update quantity via AJAX
                function updateQuantity(cartItemId, newQuantity, quantitySpan) {
                    $.ajax({
                        url: '{{ route('keranjang.update.kuantitas') }}',
                        method: 'PUT',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart_item_id: cartItemId,
                            kuantitas: newQuantity
                        },
                        success: function(response) {
                            if (response.success) {
                                // Update quantity in UI
                                quantitySpan.text(response.kuantitas);

                                // Update subtotal
                                updateSubtotal();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                }

                $('#select-all').on('change', function() {
                    let isChecked = $(this).prop('checked');
                    $('.cart-status-checkbox').each(function() {
                        $(this).prop('checked', isChecked);
                        let cartItemId = $(this).data('id');
                        let status = isChecked ? 'active' : 'inactive';
                        updateStatus(cartItemId, status, $(this));
                    });
                });

                // Individual checkbox change
                $('.cart-status-checkbox').on('change', function() {
                    let cartItemId = $(this).data('id');
                    let status = $(this).is(':checked') ? 'active' : 'inactive';
                    updateStatus(cartItemId, status, $(this));
                });

                function updateStatus(cartItemId, status, checkbox) {
                    $.ajax({
                        url: '{{ route('keranjang.update.status') }}',
                        method: 'PUT',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart_item_id: cartItemId,
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                // Update the initial status data attribute
                                checkbox.attr('data-initial-status', status);

                                updateSubtotal();
                                checkbox.closest('.booking-card').toggleClass('text-muted', status ===
                                    'inactive');
                            } else {
                                // Revert checkbox if update fails
                                checkbox.prop('checked', checkbox.attr('data-initial-status') === 'active');
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Revert checkbox if request fails
                            checkbox.prop('checked', checkbox.attr('data-initial-status') === 'active');
                            console.error('AJAX Error:', status, error);
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                }

                function updateSubtotal() {
                    let subtotal = 0;

                    $('.cart-status-checkbox:checked').each(function() {
                        let quantity = parseInt($(this).closest('.booking-card').find('.quantity').text());
                        let itemPrice = $(this).closest('.booking-card').find('.fw-bold').text().replace(
                            /[^\d]/g, '');

                        let itemSubtotal = quantity * parseInt(itemPrice);

                        subtotal += itemSubtotal;
                    });

                    $('#subtotal').text('Rp ' + new Intl.NumberFormat('id-ID').format(subtotal));
                }

                updateSubtotal();
            });

            $('.btn-remove-cart').on('click', function() {
                const cartItemId = $(this).data('item-id');
                const cartItemElement = $(this).closest('.booking-card');

                Swal.fire({
                    title: "Anda yakin?",
                    text: "Produk akan dihapus dari keranjang!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.cart') }}",
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                item_id: cartItemId
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Remove the cart item from the DOM
                                    cartItemElement.remove();
                                    location.reload();

                                    // Update subtotal
                                    updateSubtotal();

                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: "Produk berhasil dihapus dari keranjang.",
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.message || "Gagal menghapus produk.",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Terjadi kesalahan. Silakan coba lagi.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
