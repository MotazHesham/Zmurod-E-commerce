@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">بلوج</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">بلوج</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <div>
        <h1 class="text-center">
            comming soon
        </h1>
    </div>
    <!-- Blog Area Start -->
    {{-- <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    @if ($blog->type == 'Media') 
                        <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                            <div class="single-blog">
                                <div class="blog-post-media">
                                    <div class="blog-post-audio">
                                        <iframe class="embed-responsive-item" width="500" height="320" allow="autoplay"
                                            src="{{ $blog->media_url }}"></iframe>
                                    </div>
                                </div>
                                <div class="blog-text">
                                    <div class="blog-athor-date">
                                        <span> بواسطة<a class="blog-author cercle-shape" href="#"> زمرد</a></span>
                                        <span class="blog-date" href="#">25 مايو, 2023</span>
                                    </div>
                                    <h5 class="blog-heading"><a class="blog-heading-link"
                                            href="{{ route('frontend.blogbyid', $blog->id) }}">فوائد الأعمال
                                            اليدوية والمواهب</a></h5>

                                    <p>إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما
                                        تريد، النص لن يبدو مقسما
                                        ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج
                                        العميل فى كثير من
                                        الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>

                                    <a href="{{ route('frontend.blogbyid', $blog->id) }}"
                                        class="btn btn-primary blog-btn"> المزيد</a>
                                </div>
                            </div>
                        </div> 
                    @elseif ($blog->type == 'Video') 
                        <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                            <div class="single-blog">
                                <div class="blog-post-media">
                                    <div class="blog-post-video position-relative">
                                        <a class="venobox venoboxvid video-icon overflow-hidden vbox-item"
                                            data-gall="gall-video" data-autoplay="true" data-vbtype="video"
                                            href="https://youtu.be/Hx64uvCA_zQ">
                                            <img class="img-responsive w-100 thumb-image"
                                                src="{{ asset('assets/images/blog-image/1.jpg') }}" alt="">
                                            <img class="icon"
                                                src="{{ asset('assets/images/icons/icon-youtube-play.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="blog-text">
                                    <div class="blog-athor-date">
                                        <span> بواسطة<a class="blog-author cercle-shape" href="#"> زمرد</a></span>
                                        <span class="blog-date" href="#">25 مايو, 2023</span>
                                    </div>
                                    <h5 class="blog-heading"><a class="blog-heading-link"
                                            href="{{ route('frontend.blogbyid', $blog->id) }}">فوائد الأعمال اليدوية
                                            والمواهب</a></h5>

                                    <p>إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما
                                        تريد، النص لن يبدو مقسما
                                        ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج
                                        العميل فى كثير من
                                        الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>

                                    <a href="{{ route('frontend.blogbyid', $blog->id) }}"
                                        class="btn btn-primary blog-btn"> المزيد</a>
                                </div>
                            </div>
                        </div> 
                    @else
                        <!-- Start single blog -->
                        <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{ route('frontend.blogbyid', $blog->id) }}"><img
                                            src="{{ asset('assets/images/blog-image/1.jpg') }}" class="img-responsive w-100"
                                            alt=""></a>
                                </div>
                                <div class="blog-text">
                                    <div class="blog-athor-date">
                                        <span> بواسطة<a class="blog-author cercle-shape" href="#"> زمرد</a></span>
                                        <span class="blog-date" href="#">25 مايو, 2023</span>
                                    </div>
                                    <h5 class="blog-heading"><a class="blog-heading-link"
                                            href="{{ route('frontend.blogbyid', $blog->id) }}">فوائد الأعمال
                                            اليدوية والمواهب</a></h5>

                                    <p>إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما
                                        تريد، النص لن يبدو مقسما
                                        ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج
                                        العميل فى كثير من
                                        الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>

                                    <a href="{{ route('frontend.blogbyid', $blog->id) }}"
                                        class="btn btn-primary blog-btn"> المزيد</a>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    @endif
                    @endforeach


            </div>

            <!--  Pagination Area Start -->
            <div class="pro-pagination-style text-center mt-0 mb-0" data-aos="fade-up" data-aos-delay="200">
                <div class="pages">
                    <ul>
                        <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        <li class="li"><a class="page-link active" href="#">1</a></li>
                        <li class="li"><a class="page-link" href="#">2</a></li>
                        <li class="li"><a class="page-link" href="#">3</a></li>
                        <li class="li"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--  Pagination Area End -->
        </div>
    </div> --}}
    <!-- Blag Area End -->
@endsection
