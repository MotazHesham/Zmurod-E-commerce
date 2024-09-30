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
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
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

                <form id="search-form">
                    <input type="hidden" name="category" value="{{ $category ?? ''}}" id="">
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
                                    <select class="shop-sort" name="sort_by" onchange="filter()" >
                                        <option data-display="Default">Default</option> 
                                        <option value="price_low"  @isset($sort_by) @if($sort_by == 'price_low') selected @endif @endisset> Price, low to high</option>
                                        <option value="price_high" @isset($sort_by) @if($sort_by == 'price_high') selected @endif @endisset> Price, high to low</option>
                                    </select>

                                </div>
                            </div> 

                        </div>
                    </div>
                </form>
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
                                        @foreach ($products as $product)  
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
                                                <!-- Single Prodect --> 
                                                @include('partials.product-item',['product'=>$product])
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
                            {{ $products->appends(request()->input())->links() }}
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

@section('scripts')
    <script>
        function filter(){ 
            $('#search-form').submit();
        }
    </script>
@endsection