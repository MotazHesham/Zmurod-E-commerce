@extends('layouts.frontend')
@section('content')

  <!-- breadcrumb-area start -->
  <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">المنتجات</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المنتجات</li>
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
            <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                <!-- Swiper -->
                <div class="swiper-container zoom-top">
                    <div class="swiper-wrapper">
                        @foreach ($product->image as $media)
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto" src="{{asset($media->getUrl())}}"
                                    alt="">
                            </div> 
                        @endforeach
                    </div>
                </div>
                <div class="swiper-container mt-20px zoom-thumbs ">
                    <div class="swiper-wrapper">
                        @foreach ($product->image as $media)
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto" src="{{asset($media->getUrl())}}"
                                    alt="">
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                <div class="product-details-content quickview-content ml-25px">
                    <h2>{{$product->name}}</h2>
                    <div class="pricing-meta">
                        <ul class="d-flex">
                            <li class="new-price">{{$product->price}}</li>
                            <li class="old-price"><del>{{($product->price)+($product->price)*0.25}}</del></li>
                        </ul>
                    </div>
                    <div class="pro-details-rating-wrap">
                        <div class="rating-product">
                            @include('partials.rates',['rate' => $product->rating])
                        </div>
                        <span class="read-review"><a class="reviews" href="#">( {{$product->reviews->where('published',1)->count()}} )</a></span>
                    </div>
                    <div class="stock mt-30px">
                        <span class="avallabillty">الإتاحة: <span class="in-stock">
                            <i class="fa fa-check"></i>متاح</span></span>
                    </div>
                    <p class="mt-30px mb-0"> {!! $product->information !!} </p>
                    <form action="{{route("customer.cart.store")}}" method="POST">
                        @csrf 
                        <div class="pro-details-quality">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1" />
                            </div>
                            <div class="pro-details-cart">
                                @auth
                                    <button class="add-cart" type="submit"> اضف الى السلة</button>
                                @else
                                    <a class="add-cart" href="{{ route('frontend.userlogin') }}"> اضف الى السلة</a>
                                @endauth
                            </div> 
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                @auth
                                    <a @auth onclick="add_to_whitelist('{{ $product->id }}')" href="#"   @else href="{{ route('frontend.userlogin') }}" @endauth><i class="pe-7s-like"></i></a>
                                @else
                                    <a  href="{{ route('frontend.userlogin') }}"><i class="pe-7s-like"></i></a>
                                @endauth 
                            </div>
                        </div>
                    </form>
                    <div class="pro-details-categories-info pro-details-same-style d-flex">
                        <span>الكلمات الدالة: </span>

                        <ul class="d-flex">
                            @foreach($product->product_tags as $key => $product_tags) 
                                <li>
                                    <a href="#">{{ $product_tags->name }} ,</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="pro-details-social-info pro-details-same-style d-flex">
                        <span>مشاركة: </span>
                        <ul class="d-flex">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-google"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- product details description area start -->
<div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav"> 
                <a class="active" data-bs-toggle="tab" href="#des-details1">الوصف</a>
                <a data-bs-toggle="tab" href="#des-details3">التقييمات ({{$product->reviews->where('published',1)->count()}})</a>
            </div>
            <div class="tab-content description-review-bottom"> 
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p>
                            {!! $product->information !!}
                        </p>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="review-wrapper">
                                @forelse($product->reviews->where('published',1) as $review)
                                <div class="single-review"> 
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    <h4>{{ $review->user_review->name ?? '' }}</h4>
                                                </div>
                                                <div class="rating-product">
                                                    @include('partials.rates',['rate'=>$review->rating])
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                {{ nl2br($review->comment) }}
                                            </p>
                                        </div>
                                    </div>
                                </div> 
                                @empty 
                                    <p>No Review For This Product ... </p>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="ratting-form-wrapper pl-50">
                                <h3>إضافة تقييم</h3>
                                <div class="ratting-form">
                                    <form action="{{ route('frontend.rating') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <div class="star-box">
                                            <span>التقييم</span>
                                            <select name="rating" class="form-control" id="" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5" selected>5</option>
                                            </select>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-12">
                                                <div class="rating-form-style form-submit">
                                                    <textarea name="comment" placeholder="أكتب تقييمك" required></textarea>
                                                    @auth 
                                                        <button class="btn btn-primary btn-hover-color-primary "
                                                            type="submit" value="Submit">ارسال</button>
                                                    @else 
                                                        <a class="btn btn-primary btn-hover-color-primary "
                                                            href="{{ route('frontend.userlogin') }}">ارسال</a>
                                                    @endauth
                                                </div>
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
<!-- product details description area end -->

<!-- Related product Area Start -->
<div class="related-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center line-height-1">
                    <h2 class="title"> منتجات ذات علاقة</h2> 
                </div>
            </div>
        </div>
        <div class="new-product-slider swiper-container slider-nav-style-1 pb-100px">
            <div class="new-product-wrapper swiper-wrapper">
                @foreach ($related_products as $product ) 
                    <div class="new-product-item swiper-slide">
                        @include('partials.product-item',['product' => $product])
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
