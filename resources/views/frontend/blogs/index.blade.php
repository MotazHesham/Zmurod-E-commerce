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
    <!-- Blog Area Start -->
    <div class="blog-grid pb-100px pt-100px main-blog-page single-blog-page">
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
                                        <span> بواسطة<a class="blog-author cercle-shape" href="#">
                                                {{ $blog->user->name }}</a></span>
                                        <span class="blog-date"
                                            href="#">{{ date('d-M-Y', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <h5 class="blog-heading"><a class="blog-heading-link"
                                            href="{{ route('frontend.blogs.show', $blog->id) }}">{{ $blog->title }}
                                        </a></h5>

                                    <p>{{ $blog->short_description }}</p>

                                    <a href="{{ route('frontend.blogs.show', $blog->id) }}"
                                        class="btn btn-primary blog-btn">
                                        المزيد</a>
                                </div>
                            </div>
                        </div>
                    @elseif ($blog->type == 'Video')
                        <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                            <div class="single-blog">
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
                                            href="{{ route('frontend.blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                    </h5>
                                    <p>{{ $blog->short_description }}</p>
                                    <a href="{{ route('frontend.blogs.show', $blog->id) }}"
                                        class="btn btn-primary blog-btn">المزيد</a>
                                </div>
                            </div>

                        </div>
                    @else
                        <!-- Start single blog -->
                        <div class="col-lg-6 col-md-6 col-xl-4 mb-50px">
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{ route('frontend.blogs.show', $blog->id) }}"><img
                                            src="{{ isset($blog->photo) ? $blog->photo->getUrl() : 'null' }}"
                                            class="img-responsive w-100" alt=""></a>
                                </div>
                                <div class="blog-text">
                                    <div class="blog-athor-date">
                                        <span> بواسطة<a class="blog-author cercle-shape" href="#">
                                                {{ $blog->user->name }}</a></span>
                                        <span class="blog-date" href="#">
                                            {{ date('d-M-Y', strtotime($blog->created_at)) }} </span>
                                    </div>
                                    <h5 class="blog-heading"><a class="blog-heading-link"
                                            href="{{ route('frontend.blogs.show', $blog->id) }}">{{ $blog->title }}
                                        </a></h5>

                                    <p>{{ $blog->short_description }}</p>

                                    <a href="{{ route('frontend.blogs.show', $blog->id) }}"
                                        class="btn btn-primary blog-btn">
                                        المزيد</a>
                                </div>
                            </div>
                        </div>
                        <!-- End single blog -->
                    @endif
                @endforeach
            </div>
            <!--  Pagination Area Start -->
            <div class="pro-pagination-style text-center mt-0 mb-0 row justify-content-center" data-aos="fade-up"
                data-aos-delay="200">
                <div class="pages col-2">
                    {{ $blogs->links() }}
                </div>
            </div>
            <!--  Pagination Area End -->
        </div>
    </div>
    <!-- Blag Area End -->
@endsection
