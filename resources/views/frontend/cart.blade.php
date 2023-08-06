@extends('layouts.frontend')
@section('content')

<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h2 class="breadcrumb-title">سلة التسوق</h2>
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">سلة التسوق</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- Cart Area Start -->
<div class="cart-main-area pt-100px pb-100px">
    <div class="container">
        <h1 class="cart-page-title" style="text-align: center;color:crimson; font-size: 40px;">Your cart items</h1>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>صورة المنتج</th>
                                    <th>أسم المنتج</th>
                                    <th> السعر  </th>
                                    <th>العدد</th>
                                    <th>الأجمالي</th>
                                    <th>حذف / تعديل</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Products --}}
                                @foreach (auth()->user()->cart()->with('product')->get() as $cart) 
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px"
                                                    src="{{$cart->product->image[0]->getUrl()}}" alt="" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$cart->product->name}}</a></td>
                                        <td class="product-price-cart"><span class="amount">{{$cart->price_with_discount}}</span></td>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <div class="dec qtybutton" >-</div>
                                                    <input id="quantity-{{$cart->product_id}}" onchange="updateCart('{{$cart->product_id}}')" class="cart-plus-minus-box quantity-input" onkeyup="updateCart('{{$cart->product_id}}')" type="number"
                                                        name="qtybutton" 
                                                        value="{{$cart->quantity}}" />
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                        </td>
                                        <td  id="totalcost-{{$cart->product_id}}"  class="product-subtotal">{{ $cart->total_cost }}</td>
                                        <td class="product-remove">
                                            {{-- pass product id onclick to ajax request to delete from cart --}}
                                            <button onclick="remove_from_cart('{{$cart->id}}')"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">استمر في التسوق</a>
                                </div>
                                <div class="cart-shiping-update">
                                    <a href="{{route('frontend.checkout')}}">الذهاب لتسجيل الطلب</a>
                                </div>
                                <div class="cart-clear">
                                    <button>تحديث</button>
                                    <a href="#">حذف الكل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Area End -->

@endsection

@section('scripts')
@parent
<script>
    function updateCart(id) {
        var value = $('#quantity-'+ id).attr('value');
        console.log(value);
        $.ajax({
                    type: "POST",
                    url: '{{ route("customer.cart.store") }}',
                    data: {
                        product_id: id,
                        quantity : parseInt(value) ,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        if(data.exist){
                            $('#cart-item-' + data.cart_id).html(data.html);
                            $('#header-action-num').text(data.count);
                        }else{
                            $('#modal-cart-list').append(data.html);
                            $('#header-action-num').text(data.count);
                        }
                        $('#totalcost-'+ id).html(data.totalcost);
                        // showToast('success', 'تمت إضافة المنتج إلى السلة بنجاح');
                    }
                });
    }
</script>
@endsection
