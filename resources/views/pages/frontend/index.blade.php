@extends('layouts.frontend')

@section('title')
Dhilla Stuff
@endsection

@push('prepend-style')
    <style>
    .hero-section {
        height: 500px; /* Set the desired height for your hero section, 1/3 of the original */
    }

    .hero-items {
        height: 100%; /* Adjust the height to fill the hero section */
    }

    .single-hero-items {
        height: 100%; /* Make each hero item fill the container */
        background-size: cover; /* Maintain image aspect ratio and cover the container */
        background-position: center; /* Center the background image */
        max-width: 100%; /* Make sure the image doesn't exceed the container width */
        margin: 0; /* Remove any default margin */
    }

    /* Update the media query for mobile responsiveness */
    @media (max-width: 767px) {
        .single-hero-items img {
            width: 100%; /* Make sure the image fills the container on small screens */
        }
    }
    </style>
@endpush

@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items d-none d-md-block set-bg" data-setbg="{{ url('frontend/img/banner1.PNG') }}"></div>
        <div class="single-hero-items">
            <img src="{{ url('frontend/img/banner1.PNG') }}" alt="Hero Image 1" class="d-md-none img-fluid" style="width: 80%; height: 80%; object-fit: cover; object-position: center; max-width: 100%; margin: 0;">
        </div>
        <div class="single-hero-items d-none d-md-block set-bg" data-setbg="{{ url('frontend/img/banner2.PNG') }}"></div>
        <div class="single-hero-items">
            <img src="{{ url('frontend/img/banner2.PNG') }}" alt="Hero Image 2" class="d-md-none img-fluid" style="width: 80%; height: 80%; object-fit: cover; object-position: center; max-width: 100%; margin: 0;">
        </div>
    </div>
</section>

<!-- Hero Section End -->

<!-- Banner Section Begin -->
{{-- <div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ url('frontend/img/banner-1.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Men’s</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ url('frontend/img/banner-2.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Women’s</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ url('frontend/img/banner-3.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Kid’s</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
<section class="women-banner spad mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="{{ url('frontend/img/binder.jpeg') }}">
                    {{-- <h2>Women’s</h2>
                    <a href="#">Discover More</a> --}}
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="filter-control">
                    <ul class="nav nav-tabs">
                        {{-- @foreach($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == $category->slug ? 'active' : '' }}"
                                   id="{{ $category->slug }}-tab" data-toggle="tab"
                                   href="{{ url('/shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach --}}
                    </ul>
                </div>

                <div class="product-slider owl-carousel">
                    @foreach ($products as $product)
                    <div class="product-item">
                        <div class="pi-pic">
                           {{-- check image --}}
                            @if ($product->galleries->count())
                                <img src="{{ asset('storage/'.$product->galleries->first()->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300" alt="{{ $product->name }}">
                            @endif
                            @if ($product->discount_price > 0)
                                <div class="sale">Discount</div>
                            @endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                {{-- <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li> --}}
                                <li class="w-icon active" data-product-id="{{ $product->id }}">
                                    <a href="#"><i class="icon_bag_alt"></i></a>
                                </li>

                                <li class="quick-view"><a href="{{ route('product.detail', $product->slug) }}">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{ $product->category->name }}</div>
                            <a href="#">
                                <h5>{{ $product->name }}</h5>
                            </a>
                            {{-- check price --}}
                            @if ($product->discount_price > 0)
                                <div class="product-price">
                                    Rp{{ number_format($product->discount_price, 0, ',', '.') }}
                                    <span>Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <div class="product-price">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->

<!-- Deal Of The Week Section Begin-->
{{-- <section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Deal Of The Week</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                    consectetur adipisicing elit </p>
                <div class="product-price">
                    $35.00
                    <span>/ HanBag</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>12</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>40</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>52</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="#" class="primary-btn">Shop Now</a>
        </div>
    </div>
</section> --}}
<!-- Deal Of The Week Section End -->

<!-- Man Banner Section Begin -->
{{-- <section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        <li class="active">Clothings</li>
                        <li>HandBag</li>
                        <li>Shoes</li>
                        <li>Accessories</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-1.jpg" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Coat</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $14.00
                                <span>$35.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-2.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Shoes</div>
                            <a href="#">
                                <h5>Guangzhou sweater</h5>
                            </a>
                            <div class="product-price">
                                $13.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-3.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="img/products/man-4.jpg" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Converse Shoes</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="img/products/man-large.jpg">
                    <h2>Men’s</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Man Banner Section End -->

<!-- Instagram Section Begin -->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-1.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-1.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-2.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-2.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-3.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-3.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-4.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-4.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-5.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-5.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="{{ url('frontend/img/ig-6.jpeg') }}">
        {{-- <div class="insta-item ">
            <img src="{{ url('frontend/img/ig-6.jpeg') }}" alt="" class="d-md-none img-fluid"> --}}
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="https://www.instagram.com/dhilla.stuff/" target="_blank">dhila.stuff</a></h5>
            </div>
        </div>

</div>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ url('frontend/img/latest-1.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>The Best Street Style From London Fashion Week</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ url('frontend/img/latest-2.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ url('frontend/img/latest-3.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="benefit-items">
            <div class="row">
                {{-- <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ url('frontend/img/icon-1.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>Untuk pembelian diatas Rp. 1.000.000</p>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ url('frontend/img/icon-2.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Shipping All Over Indonesia</h6>
                            <p>Pengiriman ke seluruh Indonesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ url('frontend/img/icon-3.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Secure Payment</h6>
                            <p>100% Pembayaran Aman</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->

<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-1.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-2.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-3.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-4.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-5.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partner Logo Section End -->
@endsection

@push('prepend-style')
<style>

</style>

@endpush

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.w-icon').on('click', function() {
            var productId = $(this).data('product-id');
            var quantity = 1;

            $.ajax({
                url: '/cart/' + productId + '/' + quantity,
                method: 'POST',
                data: {_token: '{{ csrf_token() }}'
            },
                success: function(response) {
                    alert('Product added to cart!');
                    console.log(response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('You must login first to add product to cart!');
                    console.error(error);
                }
            });
        });
    });
</script>
@endpush
