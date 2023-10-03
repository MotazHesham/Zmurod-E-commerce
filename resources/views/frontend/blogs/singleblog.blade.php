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
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
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
                    @if ($blog->type == 'Media')
                        <div class="single-blog">
                            <div class="blog-post-media">
                                <div class="blog-post-audio">
                                    <iframe class="embed-responsive-item" width="500" height="320" allow="autoplay"
                                        src="{{ $blog->media_url }}"></iframe>
                                </div>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <span> بواسطة<a class="blog-author cercle-shape" href="#">
                                            {{ $blog->user->name }}</a></span>
                                    <span class="blog-date"
                                        href="#">{{ date('d-M-Y', strtotime($blog->created_at)) }}</span>
                                </div>
                                <h5 class="blog-heading"><a class="blog-heading-link"
                                        href="{{ route('frontend.blogbyid', $blog->id) }}">{{ $blog->title }}
                                    </a></h5>

                                <p>{{ $blog->short_description }}</p>

                                <a href="{{ route('frontend.blogbyid', $blog->id) }}" class="btn btn-primary blog-btn">
                                    المزيد</a>
                            </div>
                        </div>
                    @elseif ($blog->type == 'Video')
                        <div class="single-blog ">
                            <div class="blog-post-media">
                                <div class="blog-post-video position-relative">
                                    <video controls>
                                        <source src="{{ $blog->video->getUrl() }}" type="{{ $blog->video->mime_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <div class="blog-text">
                                <div class="blog-athor-date">
                                    <span>بواسطة <a class="blog-author cercle-shape"
                                            href="#">{{ $blog->user->name }}</a></span>
                                    <span class="blog-date">{{ date('d-M-y', strtotime($blog->created_at)) }}</span>
                                </div>
                                <h5 class="blog-heading">
                                    <a class="blog-heading-link"
                                        href="{{ route('frontend.blogbyid', $blog->id) }}">{{ $blog->title }}</a>
                                </h5>
                                <p>{{ $blog->short_description }}</p>
                                <a href="{{ route('frontend.blogbyid', $blog->id) }}"
                                    class="btn btn-primary blog-btn">المزيد</a>
                            </div>
                        </div>
                    @else
                        <!-- start single blog post -->
                        <div class="blog-posts">
                            <div class="single-blog-post blog-grid-post">
                                <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                    <img class="img-fluid h-auto"
                                        src="{{ isset($blog->photo) ? $blog->photo->getUrl() : null }}" alt="blog" />
                                </div>
                                <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                    <div class="blog-athor-date">
                                        <span> بواسطة,<a class="blog-author cercle-shape m-5" href="#">
                                                {{ $blog->user->name }}</a></span>
                                        <span class="blog-date"
                                            href="#">{{ date('d-M-Y', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <h4 class="blog-title">{{ $blog->title }}</h4>
                                    <p data-aos="fade-up">{{ $blog->short_description }}</p>
                                    <p data-aos="fade-up" data-aos-delay="200"></p>
                                </div>
                                <div class="single-post-content">
                                    <p data-aos="fade-up" data-aos-delay="200">{{ $blog->short_description }}</p>
                                </div>
                            </div>
                            <!-- end single blog post -->
                        </div>
                    @endif
                    {{--  start tags --}}
                    <div class="blog-single-tags-share d-md-flex justify-content-between">
                        <div class="blog-single-tags d-flex" data-aos="fade-up" data-aos-delay="200">
                            <span class="title"><i class="fa fa-tags" aria-hidden="true"></i></span>
                            <ul class="tag-list">
                                @foreach ($blog->tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</a></li>
                                @endforeach
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
                    {{-- end tags --}}

                    {{-- Comments Start --}}
                    <div class="comment-area">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">التعليقات
                            ({{ $blog->blog_comments->count() }})</h2>
                        <div class="review-wrapper">
                            @foreach ($blog->blog_comments as $comment)
                                <div class="single-review" data-aos="fade-up" data-aos-delay="200">
                                    <div class="review-img">
                                        <img src="{{ asset('assets/images/comment-image/1.png') }}" alt="" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    @foreach ($comment->user_comments as $key => $value)
                                                        <h4 class="title">{{ $value['name'] }} </h4>
                                                    @endforeach

                                                    <span class="date">
                                                        {{ date('d-M-Y', strtotime($comment->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>
                                                {{ $comment->comment }}
                                            </p>
                                            <div class="review-left">
                                                <a href="#"><i class="fa fa-reply-all"></i> رد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- End Comments area  --}}
                    {{-- Start  Comment form  --}}
                    <div class="blog-comment-form">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">ترك تعليقك</h2>
                        <div class="form-inner">
                            <div class="row">
                                <form method="POST" action="{{ route('frontend.storeBlogComment', $blog->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="300">
                                        <div class="single-form mb-lm-15px">
                                            @auth
                                                <input name="user_comment" id="user_comment" type="text"
                                                    placeholder="الاسم *" value="{{ auth()->user()->name }}" readonly />
                                            @else
                                                <input name="user_comment" id="user_comment" type="text"
                                                    placeholder="الاسم *" value="" />
                                            @endauth

                                        </div>
                                    </div>

                                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                        <div class="single-form m-0">
                                            <div class="form-group">
                                                <label class="required"
                                                    for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                                                <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment"
                                                    required>{{ old('comment') }}</textarea>
                                                @if ($errors->has('comment'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('comment') }}
                                                    </div>
                                                @endif
                                                <span
                                                    class="help-block">{{ trans('cruds.comment.fields.comment_helper') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                        @auth
                                            <button class="btn btn-primary btn-hover-dark border-0 mt-30px"
                                                type="submit">اترك
                                                تعليقك</button>
                                        @else
                                            <a class="btn btn-primary btn-hover-dark border-0 mt-30px"
                                                href="{{ route('frontend.userlogin') }}">اترك تعليقك</a>
                                        @endauth

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Start  Comment form  --}}

                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3  order-lg-first col-md-12 order-md-last mt-md-50px mt-lm-50px"
                    data-aos="fade-up" data-aos-delay="200">
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
                            @php
                                $blogs = \App\Models\Blog::take(6)->get();
                            @endphp
                            <h3 class="sidebar-title">الموضوعات</h3>
                            <div class="category-post">
                                <ul>

                                    <li><a href="#" class="selected m-0"><i class="fa fa-angle-right"></i> الكل
                                            <span>({{ $blogs->count() }})</span> </a></li>
                                    @foreach ($blogs as $blog)
                                        <li><a href="{{ route('frontend.blogbyid', $blog->id) }}" class=""><i
                                                    class="fa fa-angle-right"></i>
                                                {{ $blog->title }}
                                            </a></li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>



                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">احدث الموضوعات</h3>

                            <div class="recent-post-widget">
                                @foreach ($blogs as $blog)
                                    <div class="recent-single-post d-flex">
                                        @if ($blog->type == 'Video')
                                            <div class="thumb-side">
                                                <a href="{{ route('frontend.blogbyid', $blog->id) }}"><img
                                                        src="{{ asset('assets/images/404/404.jpg') }}"
                                                        alt="" /></a>
                                            </div>
                                        @elseif ($blog->type == 'Media')
                                            <div class="thumb-side">
                                                <a href="{{ route('frontend.blogbyid', $blog->id) }}"><img
                                                        src="{{ asset('assets/images/404/404.jpg') }}"
                                                        alt="" /></a>
                                            </div>
                                        @else
                                            <div class="thumb-side">
                                                <a href="{{ route('frontend.blogbyid', $blog->id) }}"><img
                                                        src="{{ $blog->photo->getUrl() }}" alt="" /></a>
                                            </div>
                                        @endif

                                        <div class="media-side">
                                            <span class="date">{{ date('d-M-Y', strtotime($blog->created_at)) }}</span>
                                            <h5><a href="{{ route('frontend.blogbyid', $blog->id) }}">
                                                    {{ $blog->title }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach

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
