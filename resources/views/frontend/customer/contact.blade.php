@extends('layouts.frontend')
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">تواصل معنا</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">تواصل معنا</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Contact Area Start -->
<div class="contact-area pt-100px pb-100px">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-lg-8">
                    <div class="contact-form">
                        <div class="contact-title mb-30">
                            <h2 class="title" data-aos="fade-up" data-aos-delay="200">رسالتك</h2>
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد
                            </p>
                        </div>
                        @auth
                        <form class="contact-form-style" id="contact-form" action="{{route('customer.sendmessage')}}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input name="name" placeholder="name" type="text" />
                                </div>
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input name="email" placeholder="email" type="email" />
                                </div>
                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                                    <input name="subject" placeholder="subject" type="text" />
                                </div>
                                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                                    <textarea name="message" placeholder="message"></textarea>
                                    <button class="btn btn-primary mt-4" data-aos="fade-up" data-aos-delay="200"
                                        type="submit" onclick="alert('your message had been sent successfully');">ارسال</button>
                                </div>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Area End -->

<!-- map Area Start --->

{{-- <div class="contact-map">
    <div id="mapid">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe id="gmap_canvas"
                    src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
            </div>
        </div>
    </div>
</div> --}}
<!-- map Area End -->
@endsection
