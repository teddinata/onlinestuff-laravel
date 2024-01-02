@extends('layouts.frontend')

@section('title')
    {{ config('app.name') }} - Shop
@endsection

@push('prepend-style')
<style>
    li.active {
        color: #667eea;
    }
</style>
@endpush

@section('content')
 <!-- Breadcrumb Section Begin -->
 <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">

                <div class="filter-widget">
                    <h4 class="fw-title">Search</h4>
                    <form action="{{ url('/shop', ['category' => $categorySlug  ]) }}" method="GET">
                        <input class="form-control" type="text" name="keyword" placeholder="Search..." value="{{ request('keyword') }}">
                        <button type="submit" class="filter-btn mt-2">Search</button>
                    </form>
                </div>

                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        @foreach ($categories as $category)
                        <li class="" style="color: {{ request()->category == $category->slug ? '#FF0000' : '#667eea' }}; font-weight: {{ request()->category == $category->slug ? 'bold' : 'normal' }}; font-size: {{ request()->category == $category->slug ? '18px' : '16px' }}; margin-bottom: 10px; margin-top: 10px;">
                            <a href="{{ url('/shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        <div class="bc-item">
                            <label for="bc-calvin">
                                Calvin Klein
                                <input type="checkbox" id="bc-calvin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-diesel">
                                Diesel
                                <input type="checkbox" id="bc-diesel">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-polo">
                                Polo
                                <input type="checkbox" id="bc-polo">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="bc-item">
                            <label for="bc-tommy">
                                Tommy Hilfiger
                                <input type="checkbox" id="bc-tommy">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <form id="custom-price-filter-form" action="{{ route('shop', ['categorySlug' => $categorySlug]) }}" method="GET">
                        <div class="filter-range-wrap">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" name="min_price" value="{{ request('min_price') ? number_format(request('min_price')) : '' }}">
                                    <input type="text" id="maxamount" name="max_price" value="{{ request('max_price') ? number_format(request('max_price')) : '' }}">
                                </div>
                            </div>
                            <div id="custom-price-range"></div>
                        </div>
                        <button type="submit" class="filter-btn">Filter</button>
                    </form>
                </div> --}}


                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Color</h4>
                    <div class="fw-color-choose">
                        <div class="cs-item">
                            <input type="radio" id="cs-black">
                            <label class="cs-black" for="cs-black">Black</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-violet">
                            <label class="cs-violet" for="cs-violet">Violet</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-blue">
                            <label class="cs-blue" for="cs-blue">Blue</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-yellow">
                            <label class="cs-yellow" for="cs-yellow">Yellow</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-red">
                            <label class="cs-red" for="cs-red">Red</label>
                        </div>
                        <div class="cs-item">
                            <input type="radio" id="cs-green">
                            <label class="cs-green" for="cs-green">Green</label>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Size</h4>
                    <div class="fw-size-choose">
                        <div class="sc-item">
                            <input type="radio" id="s-size">
                            <label for="s-size">s</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="m-size">
                            <label for="m-size">m</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="l-size">
                            <label for="l-size">l</label>
                        </div>
                        <div class="sc-item">
                            <input type="radio" id="xs-size">
                            <label for="xs-size">xs</label>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Tags</h4>
                    <div class="fw-tags">
                        <a href="#">Towel</a>
                        <a href="#">Shoes</a>
                        <a href="#">Coat</a>
                        <a href="#">Dresses</a>
                        <a href="#">Trousers</a>
                        <a href="#">Men's hats</a>
                        <a href="#">Backpack</a>
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            {{-- <div class="select-option">
                                <select class="sorting">
                                    <option value="">Default Sorting</option>
                                </select>
                                <select class="p-show">
                                    <option value="">Show:</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            {{-- <p>Show 01- 09 Of 36 Product</p> --}}
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        {{-- check data --}}
                        @forelse ($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="product-item">
                                {{-- {{ $product->galleries->first()->image }} --}}
                                <div class="pi-pic">
                                    <img src="{{ Storage::url($product->galleries->first()->image) }}" alt="">
                                    {{-- <div class="sale pp-sale">Sale</div> --}}
                                    @if ($product->discount_price > 0)
                                        <div class="sale">Discount</div>
                                    @endif
                                    <div class="icon">
                                        <i class="icon_heart_alt"></i>
                                    </div>
                                    <ul>
                                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                        <li class="quick-view"><a href="{{ route('product.detail', $product->slug) }}">View Product</a></li>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{ $product->category->name }}</div>
                                    <a href="#">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
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
                        </div>
                        @empty
                        <div class="col-lg-12">
                            <div class="alert alert-danger text-center">
                                <strong>Oops!</strong> There is no product.
                            </div>
                            <div class="text-center">
                                <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                        @endforelse
                        {{-- end check data --}}
                    </div>
                </div>

                @if(count($products) > 0)
                <div class="loading-more">
                    <i class="icon_loading"></i>
                    <a href="#">
                        Loading More
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

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

@push('addon-style')
@endpush

@push('addon-script')


<script>
    $(function () {
        // Initialize the jQuery UI slider
        $("#custom-price-range").slider({
            range: true,
            min: 1000,
            max: 1000000,
            values: [{{ request('min_price') ?: 1000 }}, {{ request('max_price') ?: 1000000 }}],
            slide: function (event, ui) {
                $("#minamount").val(ui.values[0].toLocaleString());
                $("#maxamount").val(ui.values[1].toLocaleString());
            }
        });

        // Set initial values
        $("#minamount").val($("#custom-price-range").slider("values", 0).toLocaleString());
        $("#maxamount").val($("#custom-price-range").slider("values", 1).toLocaleString());
    });
</script>
@endpush
