@extends('layouts.frontend')
@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">المتجر</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                    {{-- <li class="breadcrumb-item active"></li> --}}
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->



<!-- Shop Page Start  -->
<div class="shop-category-area pt-100px pb-100px">
    <div class="container">
        <div class="row">

            <!-- Shop Top Area Start -->
            <div class="desktop-tab">
                <div class="shop-top-bar d-flex">

                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>
                                ترتيب حسب:</p>
                        </div>
                        <div class="shop-select">
                            <select class="shop-sort">
                                <option data-display="Default">Default</option>
                                <option value="1"> Name, A to Z</option>
                                <option value="2"> Name, Z to A</option>
                                <option value="3"> Price, low to high</option>
                                <option value="4"> Price, high to low</option>
                            </select>

                        </div>
                    </div>
                    <!-- Right Side End -->
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>عرض:</p>
                        </div>
                        <div class="shop-select show">
                            <select class="shop-sort">
                                <option data-display="12">12</option>
                                <option value="1"> 12</option>
                                <option value="2"> 10</option>
                                <option value="3"> 25</option>
                                <option value="4"> 20</option>
                            </select>

                        </div>
                    </div>
                    <!-- Right Side End -->
                    <!-- Left Side start -->

                </div>
            </div>
            <!-- Shop Top Area End -->

            <!-- Mobile shop bar -->
            <div class="shop-top-bar mobile-tab">
                <!-- Left Side End -->
                <div class="shop-tab nav d-flex justify-content-between">
                    <div class="shop-tab nav">
                        <a class="active" href="#shop-grid" data-bs-toggle="tab">
                            <i class="fa fa-th" aria-hidden="true"></i>
                        </a>
                        <a href="#shop-list" data-bs-toggle="tab">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                    </div>
                    <!-- Right Side Start -->
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>Sort By:</p>
                        </div>
                        <div class="shop-select">
                            <select class="shop-sort">
                                <option data-display="Default">Default</option>
                                <option value="1"> Name, A to Z</option>
                                <option value="2"> Name, Z to A</option>
                                <option value="3"> Price, low to high</option>
                                <option value="4"> Price, high to low</option>
                            </select>

                        </div>
                    </div>
                </div>
                <!-- Right Side End -->
                <!-- Right Side Start -->
                <div class="select-shoing-wrap d-flex align-items-center justify-content-between">
                    <div class="select-shoing-wrap d-flex align-items-center">
                        <div class="shot-product">
                            <p>عرض:</p>
                        </div>
                        <div class="shop-select show">
                            <select class="shop-sort">
                                <option data-display="12">12</option>
                                <option value="1"> 12</option>
                                <option value="2"> 10</option>
                                <option value="3"> 25</option>
                                <option value="4"> 20</option>
                            </select>

                        </div>
                    </div>
                    <!-- Right Side End -->
                    <!-- Left Side start -->
                </div>
            </div>
            <!-- Mobile shop bar -->

            <!-- Shop Bottom Area Start -->
            <div class="shop-bottom-area">

                <!-- Tab Content Area Start -->
                <div class="row">
                    <div class="col">
                        <div class="tab-content">
                            <div class="tab-pane fade show active grid-4-view" id="shop-grid">
                                <div class="row mb-n-30px">
                                    @foreach ($products as $product )
                                    {{--  start product images check exist --}}
                                    @php
                                    if (isset($product->image)) {
                                    $firstImg = isset($product->image[0]) ? $product->image[0]->getUrl() :
                                    asset('assets/images/blank.jpg');
                                    $secondImg = isset($product->image[1]) ? $product->image[1]->getUrl() :
                                    $firstImg;
                                    } else {
                                    $firstImg = asset('assets/images/blank.jpg');
                                    $secondImg = asset('assets/images/blank.jpg');
                                    }
                                    @endphp
                                    {{--  end product images check exist --}}
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up"
                                        data-aos-delay="200">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="{{route('frontend.product',$product->id)}}" class="image">
                                                    <img src="{{$firstImg}}" alt="Product">
                                                    <img class="hover-image" src="{{$secondImg}}" alt="Product">
                                                </a>
                                                <span class="badges">
                                                    <span class="new">
                                                        @foreach ($product->product_offers as $offer )
                                                        {{$offer->name}}
                                                        @endforeach
                                                    </span>

                                                </span>
                                                <div class="actions">
                                                    <a href="{{route('frontend.whitelist')}}" class="action wishlist"
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
                                                <h5 class="title"><a href="{{route('frontend.shop',$product->id)}}">
                                                        {{$product->name}}
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">{{$product->price}}</span>
                                                </span>
                                            </div>
                                            <button title="أضف الى السلة" class=" add-to-cart">أضف الى السلة</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab Content Area End -->

                <!--  Pagination Area Start -->
                <div class="pro-pagination-style text-center text-lg-end mb-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="pages">
                        <ul>
                            <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                            </li>
                            <li class="li"><a class="page-link" href="#">1</a></li>
                            <li class="li"><a class="page-link active" href="#">2</a></li>
                            <li class="li"><a class="page-link" href="#">3</a></li>
                            <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--  Pagination Area End -->
            </div>
            <!-- Shop Bottom Area End -->
        </div>
    </div>
</div>
</div>
<!-- Shop Page End  -->


@endsection
