@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">ملتقى التجار</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item active">ملتقى التجار</li>
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
            <div class="ibox-content forum-container">
                @foreach ($forums as $forum )
                <div class="forum-title ">
                    <div class="pull-left forum-desc">
                        <samll>عدد الموضوعات:  {{$forum->count()}}</samll>
                    </div>
                    <h3>{{$forum->category}}</h3>
                </div>
                @foreach ($posts as $post )
                @if ($post->post_forum->category == $forum->category)
                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-shield"></i>
                            </div>
                            <a href="{{route('frontend.post',$post->id)}}" class="forum-item-title">{{$post->title}}</a>
                            <div class="forum-sub-title">{{$post->content}}</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{rand(1,100)}}
                            </span>
                            <div>
                                <small>المشاهدات</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{$post->post_forum->count()}}
                            </span>
                            <div>
                                <small>الموضوعات</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{$post->post_comments->count()}}
                            </span>
                            <div>
                                <small>التعليقات</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

                @endforeach
            </div>
        </div>
    </div>
    <!-- Blag Area End -->
@endsection
