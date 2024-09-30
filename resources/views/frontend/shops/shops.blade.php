@extends('layouts.frontend')
@section('content')


 <!-- breadcrumb-area start -->
 <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title"> المتاجر</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المتاجر </li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Service Area Start -->

<div class="service-area pt-100px pb-100px">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            @foreach ($sellers as $seller)
                <div class="col-md-2 col-4" >
                    <div class="shops">
                        <a href="{{ route('customer.shop', ['id' => $seller->id]) }}"><img class=" img-fluid border-" src="{{$seller->photo?->getUrl()}}" alt="{{$seller->user?->name}}" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Service Area End -->




@endsection
