@extends('layouts.frontend')
@section('content')
    <!-- Course Blog Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 col-md-12 ">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            @if (isset($course->photo))
                                <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                    <img class="img-fluid h-auto" src="{{ $course->photo->getUrl() }}" alt="blog" />
                                </div>
                            @else
                                <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                    <img class="img-fluid h-auto" src="{{ asset('assets/images/blank.jpg') }}"
                                        alt="blog" />
                                </div>
                            @endif


                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date">
                                    <span class="m-5"> بواسطة,<a class="blog-author cercle-shape"
                                            href="#">{{ $course->trainer }}</a></span>
                                    <span class="blog-date mr-4"
                                        href="#">{{ $course->created_at->format('  j F    ') }}</span>
                                </div>
                                <h4 class="blog-title">{{ $course->name }}</h4>
                                <p data-aos="fade-up">{{ $course->description }}</p>
                                {{-- <p data-aos="fade-up" data-aos-delay="200"></p> --}}
                            </div>

                        </div>
                    </div>
                    <!-- single blog post -->


                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3 col-md-12 mt-md-50px mt-lm-50px" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-sidebar mr-20px">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget text-center">
                            <h3 class="sidebar-title">الاشتراك والدفع</h3>

                            <div class="instructor_pricing_widget csv2">
                                <h2> بواسطة - {{ $course->trainer }}</h2>
                                <h3 class="new-price"> {{ $course->price }}ر.س</h3>
                                <h5 class="subtitle text-right">يشمل</h5>

                                <ul class="price_quere_list text-right">
                                    <li><a href="#"> {{ $course->courses_hours }} ساعة تدريبية </a></li>
                                    <li><a href="#"> الفيدوهات المسجلة </a></li>
                                    <li><a href="#">إتاحة طوال الوقت</a></li>
                                    <li><a href="#"> تابع الدورة من اي لابتوب او موبايل </a></li>
                                </ul>
                                <h5> الشهاده :- {{ App\Models\Course::TYPE_SELECT[$course->type] }}</h5>
                            </div>
                            <br />
                            <button class="btn btn-primary btn-hover-dark border-0  blog-btn btn-center mt-30px"
                                type="submit"> اشترك الان </button>
                        </div>
                        <!-- Sidebar single item -->


                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Course Blag Area End -->
@endsection
