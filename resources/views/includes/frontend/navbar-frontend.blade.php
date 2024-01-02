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
                    <i class=" fa fa-phone"></i>
                    +62 812-3121-0431
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
                            <img src="{{ url('frontend/img/dhilastuff-logowhite.jpeg') }}" alt="" style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 50%;">
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
                        <li class="heart-icon">
                            <a href="#">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li>
                        <li class="cart-icon">
                            <a href="#">
                                <i class="icon_bag_alt"></i>
                                <span>3</span>
                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="si-pic"><img src="img/select-product-1.jpg" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6>Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="si-pic"><img src="img/select-product-2.jpg" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>$60.00 x 1</p>
                                                        <h6>Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>$120.00</h5>
                                </div>
                                <div class="select-button">
                                    <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">$150.00</li>
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
                    <li><a href="./contact.html">About Us</a></li>
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
