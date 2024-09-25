@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">ورش العمل</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">ورش العمل</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->
    <!-- Blog Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 col-md-12 ">
                    <div class="row mb-n-50">
                        @foreach ($courses as $course)
                            @php
                                $startAt = new DateTime($course->start_at);
                            @endphp
                            <!-- start single course -->
                            <div class="col-lg-6 col-md-6 mb-50px">
                                <div class="single-blog bg-gray p-10px text-center">
                                    <div class="blog-image">
                                        @if (isset($course->photo))
                                            <img class="img-responsive w-100" src="{{ $course->photo->getUrl() }}"
                                                alt="">
                                        @else
                                            <img class="img-responsive w-100" src="{{ asset('assets/images/blank.jpg') }}"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="blog-text ">
                                        <div class="blog-athor-date">
                                            <span> المدرب,<a class="blog-author cercle-shape"
                                                    href="#">{{ $course->trainer }}</a></span>
                                            <span class="blog-date" href="#"
                                                style="font-weight: bold">{{ $startAt->format('j F
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ') }}</span>
                                        </div>
                                        <h5 class="blog-heading">{{ $course->name }}</h5>
                                        <a class="btn btn-primary blog-btn btn-center"
                                            href="{{ route('frontend.courses.show', ['id' => $course->id]) }}"> المزيد</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End single course -->
                        @endforeach

                        <!--  Pagination Area Start -->
                        <div class="pro-pagination-style text-center mt-0 mb-40px" data-aos="fade-up" data-aos-delay="200">
                            <div class="pages">
                                {{ $courses->links() }}
                            </div>
                        </div>
                        <!--  Pagination Area End -->
                    </div>
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3 col-md-12 mt-md-50px mt-lm-50px" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-sidebar mr-20px">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">بحث</h3>
                            <div class="search-widget">
                                <form action="{{ route('frontend.courses.search') }}" method="POST">
                                    @csrf
                                    <input type="text" name="filter" placeholder="بحث" value="{{ old('filter') }}"
                                        required />
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>

                        </div>

                        <!-- Sidebar single item -->
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">الفئات</h3>
                            <div class="category-post">
                                <ul>
                                    @foreach ($courses as $course)
                                        <li>
                                            <a href="{{ route('frontend.courses.show', $course->id) }}"><i
                                                    class="fa fa-angle-right"></i>
                                                <span class="fw-bold ">{{ $course->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Blag Area End -->
@endsection
