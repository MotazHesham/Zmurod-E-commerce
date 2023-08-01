@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">تفاصيل الموضوع</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل الموضوع</li>
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
                <div class="col-lg-8 col-xl-9 order-lg-last col-md-12 order-md-first">
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                <img class="img-fluid h-auto" src="{{asset('assets/images/blog-image/single-blog.jpg')}}"
                                    alt="blog" />
                            </div>
                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date ml-5">
                                    <span> بواسطة,<a class="blog-author cercle-shape" href="#"> متجر ريماس</a></span>
                                    <span class="blog-date" href="#">20 مايو 2023</span>
                                </div>
                                <h4 class="blog-title"></h4>
                                <p data-aos="fade-up"></p>
                                <p data-aos="fade-up" data-aos-delay="200"></p>
                            </div>
                            <div class="single-post-content">

                                <p data-aos="fade-up" data-aos-delay="200"></p>

                            </div>
                        </div>
                        <!-- single blog post -->
                    </div>
                    {{-- Tags  --}}
                    <div class="blog-single-tags-share d-md-flex justify-content-between">
                        <div class="blog-single-tags d-flex" data-aos="fade-up" data-aos-delay="200">
                            <span class="title"><i class="fa fa-tags" aria-hidden="true"></i></span>
                            <ul class="tag-list">
                                <li><a href="#">المكرميات,</a></li>
                                <li><a href="#">الكروشية,</a></li>
                                <li class="m-0"><a href="#">الخيوط</a></li>
                            </ul>
                        </div>
                        <div class="blog-single-share mb-xs-15px d-flex" data-aos="fade-up" data-aos-delay="200">
                            <ul class="social">
                                <li class="m-0">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-dribbble"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                       {{-- Tags  --}}

                    <div class="comment-area">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">التعليقات {{$post->post_comments->count()}}</h2>
                        <div class="review-wrapper">
                            @foreach ($comments as $comment )
                            <div class="single-review" data-aos="fade-up" data-aos-delay="200">
                                <div class="review-img">
                                    <img src="assets/images/comment-image/1.png" alt="" />
                                </div>
                                <div class="review-content">
                                    <div class="review-top-wrap">
                                        <div class="review-left">
                                            <div class="review-name">
                                                <h4 class="title">{{$post->author->name}}</h4>
                                                <span class="date">{{$post->created_at->format('  j F    ')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-bottom">
                                        <p>{{$comment->comment}}</p>
                                        <div class="review-left">
                                            <a href="#"><i class="fa fa-reply-all"></i> رد</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>



                    <div class="blog-comment-form">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">ترك تعليقك</h2>
                        <div class="form-inner">
                            <div class="row">
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                    <div class="single-form mb-lm-15px">
                                        <input type="text" placeholder="الاسم *" />
                                    </div>
                                </div>
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                    <div class="single-form mb-lm-15px">
                                        <input type="email" placeholder="البريد الاكتروني *" />
                                    </div>
                                </div>
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="500">
                                    <div class="single-form mb-lm-15px">
                                        <input type="email" placeholder="الموضوع (اختياري)" />
                                    </div>
                                </div>
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="single-form m-0">
                                        <textarea placeholder="الرسالة"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                    <button class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">اترك تعليقك</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3  order-lg-first col-md-12 order-md-last mt-md-50px mt-lm-50px" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="blog-sidebar mr-20px">
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">بحث</h3>
                            <div class="search-widget">
                                <form action="#">
                                    <input placeholder="البحث" type="text" />
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">الموضوعات</h3>
                            <div class="category-post">
                                <ul>
                                    <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> الكل
                                            <span>(65)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> الكروشية
                                            <span>(12)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> المكرميات
                                            <span>(22)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> جلود
                                            <span>(19)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> الاكسسوارات
                                            <span>(17)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i> الاخشاب
                                            <span>(7)</span> </a></li>
                                    <li><a href="#" class=""><i class="fa fa-angle-right"></i>  الخزف
                                            <span>(9)</span> </a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">احدث الموضوعات</h3>

                            <div class="recent-post-widget">
                                <div class="recent-single-post d-flex">
                                    <div class="thumb-side">
                                        <a href="blog-single.html"><img
                                                src="blog-single.html" alt="" /></a>
                                    </div>
                                    <div class="media-side">
                                        <span class="date">23 اغسطس 2023</span>
                                        <h5><a href="blog-single.html">فوائد الاعمال اليدوية </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="recent-single-post d-flex">
                                    <div class="thumb-side">
                                        <a href="blog-single.html"><img
                                                src="assets/images/blog-image/2.jpg" alt="" /></a>
                                    </div>
                                    <div class="media-side">
                                        <span class="date">مايو 2023</span>
                                        <h5><a href="blog-single.html"> اشهر مشاريع الهاند ميد </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="recent-single-post d-flex">
                                    <div class="thumb-side">
                                        <a href="blog-single.html"><img
                                                src="assets/images/blog-image/3.jpg" alt="" /></a>
                                    </div>
                                    <div class="media-side">
                                        <span class="date">مايو 2023</span>
                                        <h5><a href="blog-single.html">الكروشية والتريكو </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="recent-single-post d-flex">
                                    <div class="thumb-side">
                                        <a href="blog-single-left-sidebar.html"><img
                                                src="assets/images/blog-image/1.jpg" alt="" /></a>
                                    </div>
                                    <div class="media-side">
                                        <span class="date">20 مايو 2023</span>
                                        <h5><a href="blog-single.html">الإبداع يبدا بفكرة </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Sidebar single item -->
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Blag Area End -->


@endsection
