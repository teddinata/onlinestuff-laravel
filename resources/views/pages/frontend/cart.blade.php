@extends('layouts.frontend')

@section('title')
    Dhilla Stuff - Cart
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $cartItem)
                            <tr data-product-id="{{ $cartItem->product->id }}">
                                <td class="cart-pic first-row">
                                    <img
                                        style="width: 150px; height: 150px; "
                                        src="{{ Storage::url($cartItem->product->galleries->first()->image) }}" alt="{{ $cartItem->product->galleries->first()->caption }}">
                                <td class="cart-title first-row">
                                    <h5>{{ $cartItem->product->name }}</h5>
                                </td>
                                <td class="p-price first-row">
                                    @if ($cartItem->product)
                                        @if ($cartItem->product->discount_price)
                                            <p class="unit-price" data-unit-price="{{ $cartItem->product->discount_price }}">
                                                Rp{{ number_format($cartItem->product->discount_price, 0, ',', '.') }}
                                            </p>
                                            <span class="text-danger"><del>Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</del></span>
                                        @else
                                            <p class="unit-price" data-unit-price="{{ $cartItem->product->price }}">
                                                Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}
                                            </p>
                                        @endif
                                    @endif
                                </td>

                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            {{-- <button type="button" class="dec qtybtn">-</button> --}}
                                            <input type="text" value="{{ $cartItem->quantity }}" class="quantity-input">
                                            {{-- <button type="button" class="inc qtybtn">+</button> --}}
                                        </div>
                                    </div>
                                </td>

                                <td class="total-price first-row">
                                    <p class="total" data-total="{{ $cartItem->quantity * $cartItem->product->discount_price }}">
                                        Rp{{ number_format($cartItem->quantity * $cartItem->product->discount_price, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="close-td first-row"><i class="ti-close"></i></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Empty Cart</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                            <a href="#" class="primary-btn up-cart">Update cart</a>
                        </div>
                        <div class="discount-coupon">
                            <h6>Discount Codes</h6>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Enter your codes">
                                <button type="submit" class="site-btn coupon-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span class="subtotal-amount">$0.00</span></li>
                                <li class="cart-total">Total <span class="cart-total-amount">$0.00</span></li>
                            </ul>
                            <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection

@push('addon-script')

{{-- SCRIPT CART --}}
<script>
    $(document).ready(function () {
    // Fungsi untuk menghitung total harga saat kuantitas berubah
    function updateTotalPrice(input) {
        var quantity = input.val();
        var unitPrice = parseFloat(input.closest('tr').find('.unit-price').data('unit-price'));
        var total = quantity * unitPrice;

        // Update total harga
        input.closest('tr').find('.total').data('total', total);
        input.closest('tr').find('.total').text('Rp' + total.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, '$1,'));

        // Tambahan fungsionalitas kustom setelah mengubah nilai kuantitas
        // ...
    }



    // Event handler untuk tombol + dan -
    $(document).off('click', '.qtybtn').on('click', '.qtybtn', function (event) {
        event.stopPropagation();
        var input = $(this).siblings('.quantity-input');
        var oldValue = parseInt(input.val(), 10);

        if ($(this).hasClass('inc')) {
            input.val(oldValue + 0);
        } else {
            if (oldValue > 1) {
                input.val(oldValue - 0);
            } else {
                input.val(1); // Tetapkan nilai minimal ke 1
            }
        }

        // Panggil fungsi untuk mengupdate total dan subtotal
        updateCartTotals();
    });

    // Fungsi untuk menghitung grand total, subtotal, dan memperbarui tampilan
    function updateCartTotals() {
        var subtotal = 0;

        // Iterasi setiap baris pada tabel keranjang
        $('.cart-table tbody tr').each(function () {
            var quantity = parseFloat($(this).find('.quantity-input').val());
            var unitPrice = parseFloat($(this).find('.unit-price').data('unit-price'));
            var total = quantity * unitPrice;
            subtotal += total;

            // Update total harga pada setiap baris
            $(this).find('.total').data('total', total);
            $(this).find('.total').text('Rp' + total.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, '$1,'));
        });

        // Update subtotal pada elemen dengan class "subtotal-amount"
        $('.subtotal-amount').text('Rp' + subtotal.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, '$1,'));

        // Tampilkan grand total pada elemen dengan class "cart-total-amount"
        $('.cart-total-amount').text('Rp' + subtotal.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, '$1,'));
    }

    // Event handler untuk input kuantitas
    $(document).off('input', '.quantity-input').on('input', '.quantity-input', function () {
        updateTotalPrice($(this));
        updateCartTotals();
    });

    // Pemanggilan awal fungsi untuk menginisialisasi total dan subtotal
    updateCartTotals();
});


</script>


{{-- SCRIPT CHECKOUT --}}
<script>
    $(document).ready(function () {
    // Function to update the cart
        function updateCart(cartData) {
            $.ajax({
                url: '/cart/update',
                method: 'POST',
                data: { cart: cartData, _token: '{{ csrf_token() }}' },
                dataType: 'json',
                success: function (response) {
                    console.log('Cart updated successfully');
                    alert('Cart updated successfully!');
                    // Handle success, if needed
                },
                error: function (error) {
                    console.error('Error updating cart:', error);
                    alert('Error updating cart. Please try again.');
                    // Handle errors, if needed
                }
            });
        }

        // Function to handle checkout
        function proceedToCheckout(cartData) {
            // Display a confirmation dialog
            var confirmation = confirm('Are you sure you want to proceed to checkout?');

            if (confirmation) {
                // Update the cart and proceed to checkout
                updateCart(cartData);

                // Redirect to checkout
                console.log('Proceeding to checkout with cart data:', cartData);
                window.location.href = '/checkout';
            } else {
                // User canceled the checkout
                console.log('Checkout canceled');
                alert('Checkout canceled!');
            }
        }

        // Event handler for the "PROCEED TO CHECK OUT" button
        $('.proceed-btn').on('click', function (event) {
            event.preventDefault();

            // Collect cart data from the table
            var cartData = [];
            $('.cart-table tbody tr').each(function () {
                var productId = $(this).data('product-id');
                var quantity = parseInt($(this).find('.quantity-input').val(), 10);

                cartData.push({
                    productId: productId,
                    quantity: quantity
                });
            });

            // Proceed to checkout only if the user confirms
            proceedToCheckout(cartData);
        });
    });

</script>
@endpush
