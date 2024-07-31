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
                                    <li><a>{{ $tag->name }}</a></li>
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

                    <div id="comments-container" class="comment-area">
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
                                                    <span
                                                        class="date">{{ date('d-M-Y', strtotime($post->created_at)) }}</span>
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

                            <form id="comment_form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12" data-aos="fade-up" data-aos-delay="300">
                                    <div class="single-form mb-lm-15px">
                                        @auth
                                            <input name="user_comment" id="user_comment" type="text" placeholder="الاسم *"
                                                value="{{ auth()->user()->name }}" readonly />
                                        @else
                                            <input name="user_comment" id="user_comment" type="text" placeholder="الاسم *"
                                                value="" />
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
                                        <button class="btn btn-primary btn-hover-dark border-0 mt-30px" type="submit">اترك
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
@section('scripts')
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('319a00d97b6070ad0f1a', {
            cluster: 'mt1'
        });

        var channel = pusher.subscribe('comments');
        channel.bind('App\\Events\\CommentAdded', function(data) {
            var userComment = data.data.comment.user_comment; // Get the user's comment
            var commentText = data.data.comment.comment; // Get the comment text
            var commentCreatedAt = data.data.comment.created_at; // Get the comment creation date and time

            // Create a new comment element with the received data
            var newComment = '<div class="single-review" data-aos="fade-up" data-aos-delay="200">' +
                '<div class="review-img border text-center" style="height: 55px">' +
                '<img class="ms-auto" src="{{ asset('assets/images/comment-image/user.png') }}" alt="" width="50" height="50" />' +
                '</div>' +
                '<div class="review-content">' +
                '<div class="review-top-wrap">' +
                '<div class="review-left">' +
                '<div class="review-name">' +
                '<h4 class="title">' + userComment + '</h4>' +
                '<span class="date">' + commentCreatedAt + '</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="review-bottom">' +
                '<p>' + commentText + '</p>' +
                '<div class="review-left">' +
                '<a href="#"><i class="fa fa-reply-all"></i> رد</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            // Append the new comment to the comments container
            $('#comments-container').append(newComment);
        });
    </script>
    <script>
        $('#comment_form').on('submit', function(e) {
            e.preventDefault();
            let user_name = $('#user_comment').val();
            let comment = $('#comment').val();
            $('#comment').val('');
            $.post('{{ route('frontend.post.comment') }}', {
                _token: '{{ @csrf_token() }}',
                user_name: user_name,
                comment: comment,
                post_id: '{{ $post->id }}'
            }, function(data) {
                console.log(data)
            });
        });
    </script>
@endsection
