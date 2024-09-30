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

                            @foreach ($sliders as $slider)
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
                                    @foreach ($category->products->take(8) as $product)
                                        <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px">
                                            @include('partials.product-item', ['product' => $product])
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


    <!-- Product Favourite Start -->
    <div class="product-area">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title">الاقسام المفضلة</h2>
                    </div>
                    <!-- Tab Start -->
                    <div class="tab-slider swiper-container slider-nav-style-1 small-nav">
                        <ul class="product-tab-nav nav swiper-wrapper ">
                            @foreach ($Favs_categories as $category)
                                @php
                                    $image = isset($category->icon) ? ($image = $category->icon->getUrl()) : asset('assets/images/blank.jpg');
                                @endphp
                                <li class="nav-item swiper-slide">
                                    <a class="nav-link @if ($loop->first) active @endif "
                                        data-bs-toggle="tab" href="#tab--{{ $category->name }}">
                                        <img src={{ $image }} width="100px" height="100px"
                                            alt="{{ $category->name }}">
                                        <span class="fav-span">{{ $category->name }}</span>
                                    </a>
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
                            <div class="tab-pane fade @if ($loop->first) show active @endif"
                                id="tab--{{ $category->name }}">
                                <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
                                    <div class="new-product-wrapper swiper-wrapper">
                                        <!-- Move the foreach loop to this level -->
                                        @foreach ($category->products->take(10) as $product)
                                            <div class="new-product-item swiper-slide">
                                                @include('partials.product-item', ['product' => $product])
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
     <!-- Testimonial Area Start -->
    <div class="banner-area-3 pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-lm-30px mb-md-30px">
                    <div class="single-banner">
                        <img src="{{ asset('assets/images/banner/9.jpg') }}" alt="">
                        <div class="banner-content">

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-banner">
                        <img src="{{ asset('assets/images/banner/10.jpg') }}" alt="">
                        <div class="banner-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area End -->
    <!-- Brand area start -->
    <div class="brand-area pt-100px">
        <div class="container">
            <div class="brand-slider swiper-container">
                <div class="swiper-wrapper align-items-center">
                    @foreach ($sellers as $seller)
                        <div class="swiper-slide brand-slider-item text-center">
                            <a href="#"><img class="img-fluid"
                                    src="{{ $seller->photo ? $seller->photo->getUrl() : '' }}" alt="" /></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Brand area end -->
@endsection
