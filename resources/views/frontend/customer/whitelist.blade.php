@extends('layouts.frontend')
@section('content')
 <!-- breadcrumb-area start -->
 <div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">قائمة المفضلة</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المنتجات</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->



<!-- Wishlist Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>اسم المنتج</th>
                                    <th>السعر</th>
                                    <th>أضف الى السلة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($whitelist as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img class="img-responsive ml-15px" src="{{$item->product->image[0]->getUrl()}}" alt="" /></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$item->product->name}}</a></td>
                                    <td class="product-price-cart"><span class="amount">ر.س {{$item->product->price}}</span></td>
                                    <td class="product-wishlist-cart">
                                        <button  class=" btn-success" title="أضف الى السلة" class=" add-to-cart"
                                            onclick="add_to_cart('{{$item->product->id}}')">أضف الى السلة
                                        </button> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Wishlist Area End -->


@endsection
