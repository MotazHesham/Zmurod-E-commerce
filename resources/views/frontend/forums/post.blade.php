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
                    <div class="blog-posts">
                        <div class="single-blog-post blog-grid-post">
                            @php
                                isset($post->photos[0]) ? ($img = $post->photos[0]->getUrl()) : ($img = asset('assets/images/blank.jpg'));
                            @endphp
                            <div class="blog-image single-blog" data-aos="fade-up" data-aos-delay="200">
                                <img class="img-fluid h-auto" src="{{ $img }}" alt="blog" />
                            </div>
                            <div class="blog-post-content-inner mt-30px" data-aos="fade-up" data-aos-delay="400">
                                <div class="blog-athor-date ml-5 p-2">
                                    <span> بواسطة,<a class="blog-author cercle-shape" href="#">
                                            {{ $post->author->name }}</a></span>
                                    <span class="blog-date ms-5"
                                        href="#">{{ $post->created_at->format(config('panel.date_format')) }}</span>
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
                                @foreach ($post->post_tags as $tag)
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
                    {{-- Tags  --}}

                    <div class="comment-area">
                        <h2 class="comment-heading" data-aos="fade-up" data-aos-delay="200">التعليقات
                            {{ $post->post_comments->count() }}</h2>
                        <div class="review-wrapper">
                            @foreach ($post->post_comments as $comment)
                                <div class="single-review" data-aos="fade-up" data-aos-delay="200">
                                    <div class="review-img">
                                        <img src="{{ asset('assets/images/comment-image/user.png') }}" alt=""
                                            width="50" height="50" />
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-left">
                                                <div class="review-name">
                                                    @foreach ($comment->user_comments as $user)
                                                        <h4 class="title">{{ $user->name }}</h4>
                                                    @endforeach
                                                    <span class="date">{{ $post->created_at->format('  j F    ') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-bottom">
                                            <p>{{ $comment->comment }}</p>
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

                            <form class="row" action="{{ route('frontend.post.comment') }}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                {{-- <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                    <div class="single-form mb-lm-15px">
                                        <input name='user_name' type="text" placeholder="الاسم *"
                                            value="{{ auth()->user()->name ?? '' }}" readonly />
                                    </div>
                                </div>
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="500">
                                    <div class="single-form mb-lm-15px">

                                        <input name="post" type="text" placeholder="الموضوع (اختياري)"
                                            value="{{ $post->title }}" readonly />
                                    </div>
                                </div> --}}
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                    <div class="single-form m-0">
                                        <div class="form-group">
                                            <label class="required"
                                                for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                                            <textarea placeholder="الرساله" class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment"
                                                id="comment" required>{{ old('comment') }}</textarea>
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
                                        <button class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">اترك
                                            تعليقك</button>
                                    @else
                                        <a href="{{ route('frontend.userlogin') }}"
                                            class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">اترك
                                            تعليقك</a>
                                    @endauth

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- Sidebar Area Start -->
                <div class="col-lg-4 col-xl-3  order-lg-first col-md-12 order-md-last mt-md-50px mt-lm-50px"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-sidebar mr-20px">

                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">الموضوعات</h3>
                            <div class="category-post">
                                <ul>
                                    @foreach ($forums as $forum)
                                        <li><a href="{{ route('frontend.forums') }}" class="selected m-0"><i
                                                    class="fa fa-angle-right"></i>
                                                {{ $forum->name }}
                                                <span>({{ $forum->postForumPosts->count() }})</span> </a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <!-- Sidebar single item -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">احدث الموضوعات</h3>
                            @php
                                $posts = \App\Models\Post::with('author', 'post_comments', 'post_tags', 'post_forum.postForumPosts')
                                    ->latest()
                                    ->get();

                            @endphp
                            <div class="recent-post-widget">
                                @foreach ($posts as $post)
                                    <div class="recent-single-post d-flex">
                                        <div class="thumb-side">
                                            @php
                                                isset($post->photos[0]) ? ($image = $post->photos[0]->getUrl()) : ($image = asset('assets/images/blank.jpg'));
                                            @endphp
                                            <a href="{{ route('frontend.post', $post->id) }}"><img
                                                    src="{{ $image }}" alt="" /></a>
                                        </div>
                                        <div class="media-side">
                                            <span
                                                class="date">{{ $post->created_at->format(config('panel.date_format')) }}</span>
                                            <h5><a href="{{ route('frontend.post', $post->id) }}">{{ $post->title }}
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
