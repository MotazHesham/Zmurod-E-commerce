@extends('layouts.frontend')
@section('content')
<!-- Hero/Intro Slider Start -->
<div class="section bg-color1 ptb-30px slider-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="hero-slider swiper-container slider-nav-style-1 slider-dot-style-1">
                    <!-- Hero slider Active -->
                    <div class="swiper-wrapper">
                        <!-- Single slider item -->

                        @foreach ($sliders as $slider )

                        <div class="hero-slide-item slider-height-2 swiper-slide d-flex"
                            data-bg-image="{{ $slider->photo->getUrl() }}">
                        </div>
                        @endforeach

                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination-white"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Hero/Intro Slider End -->



<!-- Product Area Start -->
<div class="product-area pt-100px">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center mb-60px">
                    <h2 class="title"> وصل حديثا</h2>
                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد </p>
                </div>
                <!-- Tab Start -->
                <div class="tab-slider nav-center nav-center-2">
                    <ul class="product-tab-nav nav justify-content-center align-items-center">
                        @foreach ($Resent_categories as $category)
                        <li class="nav-item">
                            <a class="nav-link @if ($loop->first) active @endif"
                                href="#tab-{{ $category->name }}-{{ $category->id }}" data-bs-toggle="tab">
                                <span>{{ $category->name }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title End -->

        </div>
        <!-- Section Title & Tab End -->
        {{-- Start Tab & product Container --}}
        <div class="row">
            <div class="col">
                <div class="tab-content mt-60px">
                    @foreach ($Resent_categories as $category)
                    <div class="tab-pane fade @if ($loop->first) active show @endif"
                        id="tab-{{ $category->name }}-{{ $category->id }}">
                        <div class="row">
                            @foreach ($category->products()->with('product_offers')->where('most_recent', 1)->get()->take(8) as $product)
                            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px">
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{ route('frontend.product', $product->id) }}" class="image">
                                            @php
                                            if (isset($product->image)) {
                                            $image_first = isset($product->image[0]) ? $product->image[0]->getUrl() :
                                            asset('assets/images/blank.jpg');
                                            $image_second = isset($product->image[1]) ? $product->image[1]->getUrl() :
                                            $image_first;
                                            } else {
                                            $image_first = asset('assets/images/blank.jpg');
                                            $image_second = asset('assets/images/blank.jpg');
                                            }
                                            @endphp
                                            <img src="{{ $image_first }}" alt="Product" />
                                            <img class="hover-image" src="{{ $image_second }}" alt="Product" />
                                        </a>
                                        <span class="badges">
                                            @foreach ($product->product_offers as $offer )
                                            <span class="new"> {{$offer->name}}</span>
                                            @endforeach
                                        </span>
                                        <div class="actions">
                                            <a href="{{ route('frontend.whitelist') }}" class="action wishlist"
                                                title="Wishlist"><i class="pe-7s-like"></i></a>
                                            <a href="#" class="action quickview" data-link-action="quickview"
                                                title="Quick view" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <span class="ratings">
                                            <span class="rating-wrap">
                                                <span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">( 5 Review )</span>
                                        </span>
                                        <h5 class="title"><a href="{{ route('frontend.product', $product->id) }}">{{
                                                $product->name }}
                                            </a>
                                        </h5>
                                        <span class="price">
                                            <span class="new">{{ $product->price }}</span>
                                        </span>
                                    </div>  
                                    <button  title="أضف الى السلة" class=" add-to-cart"
                                        onclick="add_to_cart('{{$product->id}}')">أضف الى السلة
                                    </button> 
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End Tab & product Container --}}
    </div>
</div>
<!-- Product Area End -->

<!-- Testimonial Area Start -->
<div class="banner-area-3 pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ">
                @foreach ($banners as $banner)
                <div class="single-banner">
                    <img src="{{$banner->banner_photo[0]->getUrl()}}" alt="">
                    <div class="banner-content">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Testimonial Area End -->

<!-- Product Favourite Start -->
<div class="product-area">
    <div class="container">
        <!-- Section Title & Tab Start -->
        <div class="row">
            <!-- Section Title Start -->
            <div class="col-12">
                <div class="section-title text-center">
                    <h2 class="title">الاقسام المفضلة</h2>
                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد </p>
                </div>
                <!-- Tab Start -->
                <div class="tab-slider swiper-container slider-nav-style-1 small-nav">
                    <ul class="product-tab-nav nav swiper-wrapper ">
                        @foreach ($Favs_categories as $category)
                        @php
                        isset($category->icon) ? ($image = $category->icon->getUrl()) :
                        asset('assets/images/blank.jpg');
                        @endphp
                        <li class="nav-item swiper-slide"><a class="nav-link @if ($loop->first) active @endif "
                                data-bs-toggle="tab" href="#tab--{{ $category->name }}"> <img src={{ $image }}
                                    width="100px" height="100px" alt="{{ $category->name }}"><span>{{ $category->name
                                    }}</span></a>
                        </li>
                        @endforeach

                    </ul>
                    <!-- Add Arrows -->
                    <div class="swiper-buttons">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title End -->

        </div>
        <!-- Section Title & Tab End -->

        <!-- Product Favourite Start -->
        <div class="row">
            <div class="col">
                <div class="tab-content mt-60px">
                    @foreach ($Favs_categories as $category)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="tab--{{ $category->name }}">
                        <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
                            <div class="new-product-wrapper swiper-wrapper">
                                <!-- Move the foreach loop to this level -->
                                @foreach ($category->products->take(10) as $product)
                                @php
                                if (isset($product->image)) {
                                $firstImg = isset($product->image[0]) ? $product->image[0]->getUrl() :
                                asset('assets/images/blank.jpg');
                                $secondImg = isset($product->image[1]) ? $product->image[1]->getUrl() : $firstImg;
                                } else {
                                $firstImg = asset('assets/images/blank.jpg');
                                $secondImg = asset('assets/images/blank.jpg');
                                }
                                @endphp
                                <div class="new-product-item swiper-slide">
                                    <div class="product">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img src="{{$firstImg}}" alt="Product" />
                                                <img class="hover-image" src="{{$secondImg}}" alt="Product" />
                                            </a>
                                            <span class="badges">
                                                @if($product->discount > 0 )
                                                <span class="sale">{{$product->discount}}%</span>
                                                @endif
                                                {{-- if product created_at 7days --}}
                                                <span class="new">new</span>

                                            </span>
                                            <div class="actions">
                                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                        class="pe-7s-like"></i></a>
                                                <a href="#" class="action quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>

                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="ratings">
                                                <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                                </span>
                                                <span class="rating-num">( 5 Review )</span>
                                            </span>
                                            <h5 class="title"><a href="single-product.html">{{$product->name}}</a>
                                            </h5>
                                            <span class="price">
                                                <span class="new">{{$product->price}}</span>
                                                <span class="old">{{$product->price *2}}</span>
                                            </span>
                                        </div>  
                                        <button title="أضف الى السلة" class=" add-to-cart"
                                            onclick="add_to_cart('{{$product->id}}')">أضف الى السلة
                                        </button> 
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Favourite End -->


<!-- Brand area start -->
<div class="brand-area pt-100px">
    <div class="container">
        <div class="brand-slider swiper-container">
            <div class="swiper-wrapper align-items-center">
                @foreach ($brands as $brand)
                <div class="swiper-slide brand-slider-item text-center">
                    <a href="#"><img class=" img-fluid" style="width: 180px; height:180px"
                            src="{{ $brand->brand_image->getUrl() }}" alt="" /></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Brand area end -->


@endsection 