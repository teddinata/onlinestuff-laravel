<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello@dhillastuff.biz.id
                </div>
                <div class="phone-service">
                    <a href="https://api.whatsapp.com/send?phone=6285157356610"><i class=" fa fa-whatsapp"> + 6285 1573 56610</i></a>
                </div>
            </div>
            <div class="ht-right">
                @guest
                    <a href="{{ url('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                @endguest

                @auth
                <form action="{{ url('logout') }}" method="post" >
                        {{ csrf_field() }}
                        <button type="submit" class="login-panel btn" ><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</button>
                        <a href=""  class="login-panel btn" ><i class="fa fa-user"></i>Hi, {{ Auth::user()->name }} <span class="caret"></span></a></i></form>
                @endauth
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ url('frontend/img/dhillastuff-logowhite.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    {{-- <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div> --}}
                </div>

                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        {{-- icon user --}}
                        {{-- <li class="nav-item dropdown" style="color: yellow;cursor: pointer;">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> <!-- Change this line -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
                                @guest
                                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </div>
                        </li> --}}
                        <li class="heart-icon">
                            <a href="#">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li>
                        <li class="cart-icon">
                            <a href="#">
                                <i class="icon_bag_alt"></i>
                                <span>{{ $cartItemsCount }}</span>
                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>

                                            @forelse ($cartItems as $cartItem)
                                                <tr>
                                                    <td class="si-pic">
                                                        @if ($cartItem->product && $cartItem->product->galleries->first())
                                                            <img
                                                                style="width: 70px; height: 70px; object-fit: cover; object-position: center;"
                                                                src="{{ Storage::url($cartItem->product->galleries->first()->image) }}" alt="">
                                                        @endif
                                                    </td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            @if ($cartItem->product)
                                                                @if ($cartItem->product->discount_price)
                                                                    <p>Rp{{ number_format($cartItem->product->discount_price, 0, ',', '.') }} x {{ $cartItem->quantity }}</p>
                                                                @else
                                                                    <p>Rp{{ number_format($cartItem->product->price, 0, ',', '.') }} x {{ $cartItem->quantity }}</p>
                                                                @endif
                                                                <h6>{{ $cartItem->product->name }}</h6>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        {{-- <a href="{{ url('cart/remove', ['id' => $cartItem->id]) }}"><i class="ti-close"></i></a> --}}
                                                        <a href="#" class="remove-from-cart border btn btn-danger" data-cart-item-id="{{ $cartItem->id }}">
                                                            <i class="fa fa-trash" style="color:white;width: 1.5rem; height: 1.5rem;"></i>
                                                        </a>
                                                        {{-- <form action="{{ url('cart/remove/' . $cartItem->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"><i class="fa fa-close"></i></button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No items in cart</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>Rp{{ $totalPriceFormatted }}</h5>
                                </div>
                                <div class="select-button">
                                    <a href="{{ route('cart.index') }}" class="primary-btn view-card">VIEW CARD</a>
                                    {{-- <a href="#" class="primary-btn checkout-btn">CHECK OUT</a> --}}
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">Rp{{ $totalPriceFormatted }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All Stuffs</span>
                    <ul class="depart-hover">
                        @foreach ($categories as $category)
                            <li class="{{ (request()->is('shop/' . $category->slug)) ? 'active' : '' }}">
                                <a href="{{ url('/shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li class="{{ (request()->is('shop')) ? 'active' : '' }}"><a href="{{ url('/shop') }}">Shop</a></li>
                    {{-- <li><a href="#">Collection</a>
                        <ul class="dropdown">
                            <li><a href="#">Men's</a></li>
                            <li><a href="#">Women's</a></li>
                            <li><a href="#">Kid's</a></li>
                        </ul>
                    </li> --}}
                    {{-- foreach categories --}}
                    @foreach ($categories as $category)
                        <li class="{{ (request()->is('shop/' . $category->slug)) ? 'active' : '' }}">
                            <a href="{{ url('/shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                    {{-- <li><a href="./blog.html">Blog</a></li> --}}
                    {{-- <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="./blog-details.html">Blog Details</a></li>
                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                            <li><a href="./check-out.html">Checkout</a></li>
                            <li><a href="./faq.html">Faq</a></li>
                            <li><a href="./register.html">Register</a></li>
                            <li><a href="./login.html">Login</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<!-- Header End -->

@push('addon-style')
    <style>

    </style>

@endpush

@push('addon-script')
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
    $('.si-close a').on('click', function(event) {
        event.preventDefault();

        var cartItemId = $(this).data('cart-item-id');

        // Tambahkan konfirmasi sebelum menghapus
        if (confirm('Are you sure you want to remove this product from the cart?')) {
            $.ajax({
                url: '/cart/remove/' + cartItemId,
                method: 'POST', // Ganti DELETE dengan POST
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE' // Tambahkan _method dengan nilai DELETE
                },
                success: function(response) {
                    alert('Product removed from cart!');
                    console.log(response);

                    // Tambahkan session alert disini
                    @php
                        Session::flash('alert', [
                            'type' => 'success',
                            'message' => 'Product removed from cart successfully!',
                        ]);
                    @endphp

                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error removing product from cart.');
                    console.error(error);
                }
            });
        }
    });
});
</script>
@endpush
