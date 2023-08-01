@extends('layouts.frontend')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">اسم المتجر </h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                    <li class="breadcrumb-item active" style="font-size: 40px; color: red;">{{$seller->name}}</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <div class="single-product-gallery mb-30px">
                        <div class="single-product-slider-wrapper d-flex flex-wrap">
                            @foreach ($products as $product )
                                @if (isset($product->image))
                                    @foreach ($product->media as $img )
                                        <div class="single-product-slider-item" data-aos="fade-up" data-aos-delay="200">
                                            <a href="#"><img class="img-responsive" src="{{$img->getUrl()}}" alt="slider-item-img"></a>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content ml-25px">
                        <h1 class="text-center"><?php echo $seller->description ?></h1><hr>
                            <h3 class="text-center"> احدث المنتجات</h3>
                            @foreach ($products as $product )
                                <h4 style="color: rgb(235, 74, 74); font-size: 35px;">{{$product->name}}</h4>
                                <h6 style="font-size: 25px"><?php echo $product->information  ?></h6>
                                <br>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Related product Area Start -->
<div class="related-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center line-height-1">
                    <h2 class="title"> منتجات  المتجر</h2>
                    <p class="sub-title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                    </p>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($products as $product )
                    <div class="new-product-item swiper-slide">
                        @include('partials.product-item',$product)
                    </div>
                @endforeach
            </div>
            <!-- Add Arrows -->
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- Related product Area End -->



