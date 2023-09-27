<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="" content="" />
    <title>Zmurod .. زمرد</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Add site Favicon -->
    <link rel="shortcut icon" href="#" type="image/png">


    <!-- vendor css (Icon Font) -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font.awesome.css') }}" />

    <!-- plugins css (All Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/venobox.css') }}" />


    <link href="{{ asset('assets/font/stylesheet.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/dropzone.min.css') }}">


</head>

<body dir="rtl">


    <!-- Header Area Start -->

    <header class="header">
        <div class="header-main sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('frontend.home') }}">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Site Logo" />
                            </a>
                        </div>
                    </div>
                    <div class="col align-self-center d-none d-lg-block">
                        <div class="main-menu">
                            <ul>
                                <li><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                                <li class="dropdown position-static">
                                    <a href="#">التسوق <i class="fa fa-angle-down"></i></a>
                                    <ul class="mega-menu d-block">
                                        <li class="d-flex">
                                            <ul class="d-block " id="#categoryList">
                                                <li class="title"><a href="#">الفئات الرئيسية</a></li>
                                                @foreach (\App\Models\Category::all() as $category)
                                                    <li><a
                                                            href="{{ route('customer.marketshop', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="d-block">
                                                <li class="title"><a href="#">احدث المنتجات</a></li>
                                                @foreach (\App\Models\Product::where('published', 1)->orderBy('updated_at', 'desc')->take(5)->get() as $product)
                                                    <li><a
                                                            href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul class="d-block">
                                                <li class="title"><a href="#">المنتجات الاكثر مبيعا</a></li>
                                                @foreach (\App\Models\Product::where('published', 1)->take(5)->get() as $product)
                                                    <li><a
                                                            href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <ul
                                                class="d-flex align-items-center p-0 border-0 flex-column justify-content-center">
                                                <li>
                                                    <a class="p-0" href="shop-left-sidebar.html">
                                                        <img class="img-responsive w-100"
                                                            src="{{ asset('assets/images/logo.png') }}" alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('frontend.courses') }}">ورش العمل</a></li>
                                <li><a href="{{ route('customer.shops') }}">المتاجر</a></li>
                                <li><a href="{{ route('frontend.forums') }}">ملتقى التجار</a></li>
                                <li><a href="{{ route('frontend.blogs') }}">البلوج</a></li>
                                <li><a href="{{ route('customer.contact-us') }}">تواصل معنا</a></li>
                            </ul>
                        </div>
                    </div>

                    @php
                        $login_route = route('frontend.userlogin');
                    @endphp

                    <div class="col col-lg-auto align-self-center pl-0">
                        <div class="header-actions">
                            <a href="#" class="header-action-btn" data-bs-toggle="modal"
                                data-bs-target="#searchActive">
                                <i class="pe-7s-search"></i>
                            </a>
                            <div class="header-bottom-set dropdown">
                                <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown">
                                    <i class="pe-7s-users"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @auth
                                        @php
                                            $route = auth()->user()->user_type == 'customer' ? 'customer.home' : 'seller.home';
                                        @endphp
                                        <li><a class="dropdown-item" href="{{ route($route) }}">حسابي</a></li>
                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">تسجيل
                                                الخروج </a>
                                        </li>
                                    @else
                                        <li> <a class="dropdown-item" href="{{ route('frontend.userlogin') }}">تسجيل
                                                الدخول</a></li>
                                        <li> <a class="dropdown-item" href="{{ route('frontend.register') }}">تسجيل حساب
                                                جديد
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            <a @auth href="#offcanvas-wishlist" @else href="#"
                                onclick="location.href='{{ $login_route }}'" @endauth
                                class="header-action-btn offcanvas-toggle">
                                <i class="pe-7s-like"></i>
                            </a>
                            <a @auth href="#offcanvas-cart" @else href="#" onclick="location.href='{{ $login_route }}'" @endauth
                                class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                                <i class="pe-7s-shopbag"></i>

                                <span id="header-action-num" class="header-action-num">@auth
                                        {{ \App\Models\Cart::where('user_id', auth()->user()->id)->count() }}
                                    @else
                                        0
                                    @endauth
                                </span>
                            </a>
                            <a href="#offcanvas-mobile-menu"
                                class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                                <i class="pe-7s-menu"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->
    <div class="offcanvas-overlay"></div>

    <!-- OffCanvas Wishlist Start -->
    <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
        <div class="inner">
            <div class="head">
                <span class="title">قائمة الامنتيات</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">
                <ul class="minicart-product-list" id="modal-whitlist-list">
                    @auth
                        @foreach (auth()->user()->whitelist()->with('product')->get() as $whitelist)
                            @php
                                if (isset($whitelist->product->image)) {
                                    $image_first = isset($whitelist->product->image[0]) ? $whitelist->product->image[0]->getUrl() : asset('assets/images/blank.jpg');
                                } else {
                                    $image_first = asset('assets/images/blank.jpg');
                                }
                            @endphp
                            <li id="whitlist-item-{{ $whitelist->id }}">
                                <a href="#" class="image"><img src="{{ $image_first }}"
                                        alt="Whitlist product Image"></a>
                                <div class="content">
                                    <a href="#" class="title ml-3">
                                        <h6>{{ $whitelist->product->name }}</h6>
                                    </a>
                                    <span class="amount">${{ $whitelist->product->price }}</span>
                                    <a href="#" onclick="deleteFromWhitelist('{{ $whitelist->id }}')"
                                        class="remove">×</a>
                                </div>
                            </li>
                        @endforeach
                    @endauth

                </ul>
            </div>
            <div class="foot">
                <div class="buttons">
                    <a href="{{ route('customer.whitelist.show') }}" class="btn btn-dark btn-hover-primary mt-30px">
                        عرض
                        قائمة
                        الامنيات</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->

    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart">
        <div class="inner">
            <div class="head">
                <span class="title">سلة التسوق</span>
                <button id="openCartModal" class="offcanvas-close">×</button>
            </div>

            <div class="body customScroll">
                <ul class="minicart-product-list" id="modal-cart-list">
                    @auth
                        @foreach (auth()->user()->cart()->with('product')->get() as $cart)
                            @php
                                if (isset($cart->product->image)) {
                                    $image_first = isset($cart->product->image[0]) ? $cart->product->image[0]->getUrl() : asset('assets/images/blank.jpg');
                                } else {
                                    $image_first = asset('assets/images/blank.jpg');
                                }
                            @endphp
                            <li id="cart-item-{{ $cart->id }}">
                                <a href="" class="image"><img src="{{ $image_first }}"
                                        alt="Cart product Image"></a>
                                <div class="content">
                                    <a href="" class="title"
                                        style="font-size: 20px;">{{ $cart->product->name ?? '' }}</a>
                                    <div class="d-flex justify-content-around">
                                        <span class="quantity" style="font-size: 25px; "> x{{ $cart->quantity }}</span>
                                        <span class="price"
                                            style="font-size: 20px;"><strong>{{ $cart->price_with_discount }}</strong></span>
                                    </div>
                                </div>
                                <a class="remove" href="#" onclick="remove_from_cart('{{ $cart->id }}')">×</a>

                            </li>
                        @endforeach
                    @endauth
                </ul>
            </div>
            <div class="foot">
                <div class="buttons mt-30px">
                    <a href="{{ route('customer.cart.show') }}" class="btn btn-dark btn-hover-primary mb-30px">عرض
                        سلة
                        التسوق</a>
                    <a href="{{ route('frontend.checkout') }}" class="btn btn-outline-dark current-btn">صفحة
                        الدفع</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Menu Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <button id="openCartModal" class="offcanvas-close">x</button>

        <div class="inner customScroll">

            <div class="offcanvas-menu mb-4">
                <ul>
                    <li><a href="{{ route('frontend.home') }}"><span class="menu-text">الرئيسية</span></a>
                    </li>

                    <li><a href="#"><span class="menu-text">التسوق</span></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="#"><span class="menu-text">الفئات الرئيسية</span></a>
                                <ul class="sub-menu">
                                    @foreach (\App\Models\Category::all() as $category)
                                        <li>
                                            <a
                                                href="{{ route('customer.marketshop', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">المنتجات</span></a>
                                <ul class="sub-menu">
                                    @foreach (\App\Models\Product::where('published', 1)->orderBy('updated_at', 'desc')->take(5)->get() as $product)
                                        <li>
                                            <a
                                                href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#"><span class="menu-text">المنتجات الاكثر مبيعا</span></a>
                                <ul class="sub-menu">
                                    @foreach (\App\Models\Product::where('published', 1)->take(5)->get() as $product)
                                        <li>
                                            <a
                                                href="{{ route('frontend.product', $product->id) }}">{{ $product->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li><a href="{{ route('frontend.courses') }}"> ورش العمل</a></li>
                    <li>
                    <li><a href="{{ route('customer.shops') }}"> المتاجر</a></li>
                    <li>
                    <li><a href="{{ route('frontend.forums') }}">ملتقى التجار</a></li>
                    <li>
                    <li><a href="{{ route('frontend.blogs') }}">البلوج</a></li>
                    <li>
                    <li><a href="{{ route('customer.contact-us') }}"> تواصل معنا</a></li>
                </ul>
            </div>
            <!-- OffCanvas Menu End -->
            <div class="offcanvas-social mt-auto">
                <ul>
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
    <!-- OffCanvas Menu End -->
    @yield('content')

    @php
        $about = \App\Models\AboutUs::find(1);
    @endphp
    <!-- Footer Area Start -->
    <div class="footer-area">
        <div class="footer-container">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Start single blog -->
                        <div class="col-md-6 col-sm-6 col-lg-5 mb-md-30px mb-lm-30px">
                            <div class="single-wedge">
                                <a href="{{ route('frontend.about-us') }}">
                                    <h4 class="footer-herading">عن زمرد</h4>
                                </a>
                                <div class="footer-about">
                                    <div class="footer-row">

                                        <p>{{ $about->vision }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-2 col-sm-6 mb-lm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">روابط سريعة</h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            @auth
                                                <li class="li"><a class="single-link" href="{{ route($route) }}">
                                                        حسابي
                                                        الشخصي</a>
                                                </li>
                                                <li class="li"><a class="single-link"
                                                        href="{{ route('frontend.cart') }}">طلباتي </a>
                                                </li>
                                                <li class="li"><a class="single-link"
                                                        href="{{ route('customer.whitelist.show') }}">قائمة
                                                        الامنيات</a></li>
                                            @else
                                                <li class="li"><a class="single-link"
                                                        href="{{ route('frontend.userlogin') }}"> تسجيل الدخول
                                                    </a>
                                                </li>
                                                <li class="li"><a class="single-link"
                                                        href="{{ route('frontend.register') }}">
                                                        تسجيل حساب جديد
                                                    </a>
                                                </li>
                                            @endauth

                                            <li class="li"><a class="single-link"
                                                    href="{{ route('customer.marketshop') }}">التسوق</a>
                                            </li>
                                            <li class="li"><a class="single-link" href="#">كيف نعمل</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-2 col-sm-6 mb-sm-30px">
                            <div class="single-wedge">
                                <h4 class="footer-herading">المتاجر </h4>
                                <div class="footer-links">
                                    <div class="footer-row">
                                        <ul class="align-items-center">
                                            @foreach (\App\Models\Seller::get()->take(5) as $seller)
                                                <li class="li">
                                                    <a class="single-link" href="#">{{ $seller->store_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                        <!-- Start single blog -->
                        <div class="col-md-6 col-lg-3 col-sm-6 pr-120px ">
                            <div class="single-wedge ">

                                <h4 class="footer-herading">تواصل معنا </h4>
                                <div class="footer-links">
                                    <!-- News letter area -->
                                    <p class="mail">للتواصل السريع والاستفسارات <br>
                                        <a href="mailto:{{ $about->email }}">{{ $about->email }}</a>
                                    </p>
                                    <p class="phone m-0">
                                        <i class="pe-7s-phone"></i>
                                        <span>
                                            <a
                                                href="tel:{{ $about->phone_number_2 }}">{{ $about->phone_number_2 }}</a>
                                            <br>
                                            <a href="tel:{{ $about->phone_number }}"> {{ $about->phone_number }}</a>
                                        </span>
                                    </p>

                                    <!-- News letter area  End -->
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="line-shape-top">
                        <div class="row flex-md-row-reverse align-items-center">
                            <div class="col-md-12 text-center">

                                <p class="copy-text"> © 2023 <strong>zumorod</strong>
                                    <strong> By Integration visions</strong></a>.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Area End -->

        <!-- Search Modal Start -->
        <div class="modal popup-search-style" id="searchActive">
            <button type="button" class="close-btn" data-bs-dismiss="modal"><span
                    aria-hidden="true">&times;</span></button>
            <div class="modal-overlay">
                <div class="modal-dialog p-0" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h2>بحث عن منتج او متجر</h2>
                            <form class="navbar-form position-relative" action="{{ route('customer.marketshop') }}"
                                role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="بحث ...">
                                </div>
                                <button type="submit" class="submit-btn"><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->
        {{-- Popup Modal --}}
        <div class="modal modal-2 fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {{-- Ajax Code here --}}
                </div>
            </div>
        </div>

        {{-- Popup Modal --}}


        <!-- Global Vendor, plugins JS -->
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

        @include('sweetalert::alert')

        <!-- Vendor JS -->
        <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

        <!--Plugins JS-->
        <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/venobox.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/ajax-mail.js') }}"></script>

        <!---dropzone--->
        <script src="{{ asset('dashboard_offline/js/dropzone.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

        <!-- Main Js -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script>
            function showAlert(type, title, message) {
                swal({
                    title: title,
                    text: message,
                    type: type,
                    showConfirmButton: 'Okay',
                    timer: 3000
                });
            }

            function showToast(type, title) {
                swal({
                    toast: true,
                    title: title,
                    type: type,
                    position: 'center-center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
            }

            function remove_from_cart(id) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route('customer.cart.remove') }}',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#modal-cart-list').find('#cart-item-' + id).remove();
                        $('#header-action-num').text(data.count);
                        showToast('success', 'تمت ازالة المنتج من السلة بنجاح');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
            // add to cart
            function add_to_cart(pId) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('customer.cart.store') }}',
                    data: {
                        product_id: pId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.exist) {
                            $('#cart-item-' + data.cart_id).html(data.html);
                            $('#header-action-num').text(data.count);
                        } else {
                            $('#modal-cart-list').append(data.html);
                            $('#header-action-num').text(data.count);
                        }
                        showToast('success', 'تمت إضافة المنتج إلى السلة بنجاح');
                    }
                });
            }
            // add to whitelist
            function add_to_whitelist(pId) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('customer.whitelist.store') }}',
                    data: {
                        product_id: pId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.exist) {
                            $('#whitlist-item-' + data.whitlist_id).html(data.html);
                        } else {
                            $('#modal-whitlist-list').append(data.html);
                        }
                        showToast('success', 'تمت إضافة المنتج إلى قائمة الامنيات بنجاح');
                    }
                });
            }
            // remove from whitelist
            function deleteFromWhitelist(wId) {
                $.ajax({
                    type: "DELETE",
                    url: '{{ route('customer.whitelist.remove') }}',
                    data: {
                        id: wId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#modal-whitlist-list').find('#whitlist-item-' + wId).remove();
                        showToast('success', 'تمت ازالة المنتج من قائمة الامنيات بنجاح');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                })
            }
            // pop up 
            function quickView(pId) {
                $.ajax({
                    type: "POST",
                    url: '{{ route('customer.popup.show') }}',
                    data: {
                        product_id: pId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#exampleModal').modal('show')
                        // 34an afdy l modal 
                        $('#exampleModal .modal-content').html(null)

                        $('#exampleModal .modal-content').html(data)
                    }
                });
            }
        </script>
        @yield('scripts')
</body>

</html>
