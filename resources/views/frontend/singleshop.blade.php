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
                    <li class="breadcrumb-item active" style="font-size: 40px; color: red;">{{$brand->name}}</li>
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
                        {{-- Brand Products images --}}
                        @foreach ($products as $product)
                        @if (isset($product->image) && count($product->image) >= 4)
                        <div class="single-product-slider-item" data-aos="fade-up" data-aos-delay="200">
                            <a href="#"><img class="img-responsive" src="{{ $product->image[0]->getUrl() }}"
                                    alt="slider-item-img"></a>
                        </div>
                        <div class="single-product-slider-item" data-aos="fade-up" data-aos-delay="400">
                            <a href="#"><img class="img-responsive" src="{{ $product->image[1]->getUrl() }}"
                                    alt="slider-item-img"></a>
                        </div>
                        <div class="single-product-slider-item" data-aos="fade-up" data-aos-delay="600">
                            <a href="#"><img class="img-responsive" src="{{ $product->image[2]->getUrl() }}"
                                    alt="slider-item-img"></a>
                        </div>
                        <div class="single-product-slider-item" data-aos="fade-up" data-aos-delay="800">
                            <a href="#"><img class="img-responsive" src="{{ $product->image[3]->getUrl() }}"
                                    alt="slider-item-img"></a>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content ml-25px">
                    <h1>
                        <?php echo $brand->brand_information ?> <br>
                    </h1>
                </div>
                @foreach ($products as $product )
                <h3>
                    <?php echo $product->information ?> <br>
                    <h3>
                        @endforeach
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
                    <h2 class="title"> منتجات المتجر</h2>
                    <p class="sub-title">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من
                        مولد النص
                    </p>
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($products as $product )
                <div class="container" style="width: 350px; height: 350px;">
                    <div class="product">
                        <div class="thumb">
                            <a href="single-product.html" class="image">
                                <img src="{{$product->image[0]->getUrl()}}" alt="Product" />
                                <img class="hover-image" src="{{$product->image[0   ]->getUrl()}}" alt="Product" />
                            </a>
                            <span class="badges">
                                @foreach ($product->product_offers as $offer )
                                {{-- <span class="sale">-10%</span> --}}
                                <span class="new">{{$offer->name}}</span>
                                @endforeach

                            </span>
                            <div class="actions">
                                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                        class="pe-7s-like"></i></a>
                                <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>

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
                        <button title="أضف الى السلة" class=" add-to-cart">أضف الى السلة</button>
                    </div>
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



@endsection
