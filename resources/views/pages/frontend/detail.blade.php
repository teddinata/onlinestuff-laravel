@extends('layouts.frontend')

@section('title')
DhillaStuff - Detail Produk
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
                    <span>Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                    <ul class="filter-catagories">
                        @foreach ($categories as $category)
                        <li><a href="{{ route('products.detail', $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div> --}}
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
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                            data-min="33" data-max="98">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <a href="#" class="filter-btn">Filter</a>
                </div>
                <div class="filter-widget">
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
                </div>
                <div class="filter-widget">
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
                <div class="filter-widget">
                    <h4 class="fw-title">Tags</h4>
                    <div class="fw-tags">
                        <a href="#">{{ $product->tags }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        {{-- @if ($products->galleries->count())
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="{{ ($products->galleries->first()->photo)}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach ($products->galleries as $gallery)
                                <div class="pt active" data-imgbigurl="{{ ($gallery->photo) }}"><img
                                    src="{{ ($gallery->photo) }}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                        @endif --}}
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="{{ Storage::url($product->galleries->first()->image)}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach ($product->galleries as $gallery)
                                <div class="pt active" data-imgbigurl="{{ Storage::url($gallery->image) }}"><img
                                    src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->caption }}"></div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Video Section -->
                        <div class="product-video mt-2">
                            <!-- Embed YouTube video using iframe -->
                            {{-- check video --}}
                            {{-- {{ $product->video_url }}
                            https://drive.google.com/file/d/1FH_7udpQxrA5aEd2UoHv4ajIJkKyYKMk/view --}}

                            @if ($product->video_url)
                            @php
                                $youtubeUrl = $product->video_url;
                                $videoId = substr(parse_url($youtubeUrl, PHP_URL_QUERY), 2);
                                $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                            @endphp

                            <iframe width="100%" height="315" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>

                            @endif
                            {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/your_video_id" frameborder="0" allowfullscreen></iframe> --}}
                            {{-- <iframe width="100%" height="315" src="https://www.youtube.com/embed/your_video_id" frameborder="0" allowfullscreen></iframe> --}}
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                                <span>{{ $product->category->name }}</span>
                                <h3>{{ $product->name }}</h3>
                                {{-- <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a> --}}
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>(5)</span>
                            </div>
                            <div class="pd-desc">
                                {{-- <p>{!! $products->description !!}</p> --}}
                                {{-- <h4>{{'Rp ' . number_format($products->price, 0, ".", ".")}} <span>629.99</span></h4> --}}
                                <p>{!! $product->description !!}</p>
                                <h4>
                                    @if ($product->discount_price)
                                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                        <span class="original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    @endif
                                </h4>
                            </div>
                            {{-- <div class="pd-color">
                                <h6>Color</h6>
                                <div class="pd-color-choose">
                                    <div class="cc-item">
                                        <input type="radio" id="cc-black">
                                        <label for="cc-black"></label>
                                    </div>
                                    <div class="cc-item">
                                        <input type="radio" id="cc-yellow">
                                        <label for="cc-yellow" class="cc-yellow"></label>
                                    </div>
                                    <div class="cc-item">
                                        <input type="radio" id="cc-violet">
                                        <label for="cc-violet" class="cc-violet"></label>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="pd-size-choose">
                                <div class="sc-item">
                                    <input type="radio" id="sm-size">
                                    <label for="sm-size">s</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="md-size">
                                    <label for="md-size">m</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="lg-size">
                                    <label for="lg-size">l</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" id="xl-size">
                                    <label for="xl-size">xs</label>
                                </div>
                            </div> --}}
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                                {{-- <form action="{{ route('cart.add', $products->id) }}" --}}
                                    <form action=""
                                    method="post">
                                    @csrf
                                    <button type="submit" class="primary-btn pd-cart">
                                        Add To Cart
                                    </button>
                                </form>
                            </div>
                            <ul class="pd-tags">
                                {{-- <li><span>CATEGORIES</span>: {{ $products->categories->name }}</li>
                                <li><span>TAGS</span>: {{ $products->tags }}</li> --}}

                                <li><span>CATEGORIES</span>: {{ $product->category->name }}</li>
                                <li><span>TAGS</span>: {{ $product->tags }}</li>
                            </ul>
                            <div class="pd-share">
                                {{-- <div class="p-code">Sku : Test</div> --}}
                                <div class="pd-social">
                                    <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <div class="tab-item">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (02)</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h5>Introduction</h5>
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                        <div class="col-lg-5">
                                            <img src="frontend/img/product-single/tab-desc.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                <div class="specification-table">
                                    <table>
                                        <tr>
                                            <td class="p-catagory">Customer Rating</td>
                                            <td>
                                                <div class="pd-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <span>(5)</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Price</td>
                                            <td>
                                                {{-- check price --}}
                                                @if ($product->discount_price)
                                                    <span class="discount">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                    <span class="original">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                @else
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="p-catagory">Availability</td>
                                            <td>
                                                <div class="p-stock">{{ $product->stock }} In Stock</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-catagory">Weight</td>
                                            <td>
                                                <div class="p-weight">{{ $product->weight ? $product->weight : '0' }} Kg</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                <div class="customer-review-option">
                                    <h4>2 Comments</h4>
                                    <div class="comment-option">
                                        <div class="co-item">
                                            <div class="avatar-pic">
                                                <img src="{{ url('frontend/img/product-single/avatar-1.png') }}" alt="">
                                            </div>
                                            <div class="avatar-text">
                                                <div class="at-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                                                <div class="at-reply">Nice !</div>
                                            </div>
                                        </div>
                                        <div class="co-item">
                                            <div class="avatar-pic">
                                                <img src="{{ url('frontend/img/product-single/avatar-2.png') }}" alt="">
                                            </div>
                                            <div class="avatar-text">
                                                <div class="at-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <h5>Roy Banks <span>27 Aug 2019</span></h5>
                                                <div class="at-reply">Nice !</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="personal-rating">
                                        <h6>Your Ratind</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                    </div>
                                    <div class="leave-comment">
                                        <h4>Leave A Comment</h4>
                                        <form action="#" class="comment-form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Name">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Email">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea placeholder="Messages"></textarea>
                                                    <button type="submit" class="site-btn">Send message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
           @foreach ($relatedProducts as $recommendation)
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ url($recommendation->galleries->first()->image ? Storage::url($recommendation->galleries->first()->image) : '') }}" alt="">
                        {{-- <img src="{{ url('frontend/img/product/1.jpg') }}" alt=""> --}}
                        <div class="sale">Sale</div>
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="{{ url ('detail', $recommendation->slug) }}">View Product</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{ $recommendation->category->name }}</div>
                        <a href="#">
                            <h5>{{ $recommendation->name }}</h5>
                        </a>
                        {{-- check price --}}
                        <div class="product-price">
                            @if ($recommendation->discount_price)
                                Rp {{ number_format($recommendation->discount_price, 0, ',', '.') }}
                                <span class="original">Rp {{ number_format($recommendation->price, 0, ',', '.') }}</span>
                            @else
                                Rp {{ number_format($recommendation->price, 0, ',', '.') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
           @endforeach
           {{-- <div class="col-lg-3 col-sm-6">
            <div class="product-item">
                <div class="pi-pic">
                    <img src="{{ url('frontend/img/product/1.jpg') }}" alt="">
                    <div class="sale">Sale</div>
                    <div class="icon">
                        <i class="icon_heart_alt"></i>
                    </div>
                    <ul>
                        <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                        <li class="quick-view"><a href="dummy/url">+ Quick View</a></li>
                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                    </ul>
                </div>
                <div class="pi-text">
                    <div class="catagory-name">Dummy Category</div>
                    <a href="#">
                        <h5>Dummy Product Name</h5>
                    </a>
                    <div class="product-price">
                        Rp 1.000.000
                        <span>Rp500.000</span>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
</div>
<!-- Related Products Section End -->
@endsection
