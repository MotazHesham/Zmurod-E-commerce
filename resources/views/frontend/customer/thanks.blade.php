@extends('layouts.frontend')
@section('content')


    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title"> شكرا لك</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الررئيسية</a></li>
                        <li class="breadcrumb-item active"> تاكيد الاوررد</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Thank You area start -->
    <div class="thank-you-area pt-100px ">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="inner_complated">
                        <div class="img_cmpted"><img src="{{asset('assets/images/icons/cmpted_logo.png')}}" alt=""></div>
                        <p class="dsc_cmpted">شكرا للطلب  من زمرد. سوف تتلقى رسالة تأكيد بالبريد الإلكتروني قريبا.</p>
                        <div class="btn_cmpted">
                            <a href="{{route('frontend.home')}}" class="shop-btn" title="Go To Shop">العودة للرئيسية </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="quick_order ">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12">
                    <div class="main_quickorder text-align-center">
                        <h3 class="title">اذا كنت تواجه اي مشكلة تواصل معنا</h3>
                        <div class="cntct typewriter-effect"><span class="call_desk"><a href="tel:+011 225 8877" id="typewriter_num">011 225 8877</a></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thank You area end -->
@endsection