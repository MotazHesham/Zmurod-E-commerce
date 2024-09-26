@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">الدفع</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">صفحة الدفع</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            @if ($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('customer.order.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>تفاصيل الدفع</h3>
                            <div class="row">
                                {{-- client_name --}}
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-4">
                                        <label>الاسم الاول</label>
                                        <input type="text" name="first_name" value="{{ auth()->user()->name }}"
                                            placeholder="Your First Name" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-4">
                                        <label>الاسم الاخير</label>
                                        <input type="text" name="last_name" value=""
                                            placeholder="Your Last Name" />
                                    </div>
                                </div>
                                {{-- shipping_address --}}
                                <div class="col-lg-12">
                                    <div class="billing-select mb-4">
                                        <label>المنطقة</label>
                                        <select name="city">
                                            <option value="">اختر المنطقة</option>
                                            @foreach (\App\Models\User::CITY_SELECT as $key => $value)
                                                <option value="{{ $key }}"
                                                    @if (auth()->user()->country == $key) selected @endif>{{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="billing-info mb-4">
                                        <label>العنوان بالتفصيل</label>
                                        <input class="billing-address" placeholder="الشارع ، اسم المنطقة" type="text"
                                            name="shipping_address" value="{{ auth()->user()->address }}" />
                                        <input placeholder="الوحدة ، الشقة." type="text" name="address_area" />
                                    </div>
                                </div>
                                {{-- phone_number --}}
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-4">
                                        <label>رقم الهاتف الاساسي </label>
                                        <input type="text" name="phone" value="{{ auth()->user()->phone }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-4">
                                        <label>رقم هاتف اخر</label>
                                        <input type="text" name="phone_2" />
                                    </div>
                                </div>

                            </div>


                            <div class="additional-info-wrap">
                                <h4>معلومات إضافية</h4>
                                <div class="additional-info">
                                    <label>ملاحظات</label>
                                    <textarea placeholder=" " name="message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Order Details --}}
                    <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                        <div class="your-order-area">
                            <h3>تفاصيل الطلب الخاص بك</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>المنتجات</li>
                                            <li>الاجمالي</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach (auth()->user()->cart()->with('product')->get() as $cart)
                                                <li>
                                                    <span class="order-middle-left" style="font-size: 20px;">
                                                        {{ $cart->product->name }} x {{ $cart->quantity }} </span>
                                                    <span class="order-price" style="font-size: 20px; color: red;">
                                                        {{ $cart->total_cost }} </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li>
                                                <input name="shipment_type" class="shipment_type" type="radio"
                                                    value="normal" style="height: 25px;" /> الشحن العادي
                                                <span>{{ $normal }}</span>
                                            </li>
                                            <li>
                                                <input name="shipment_type" class="shipment_type" type="radio"
                                                    value="fast" style="height: 25px;" /> الشحن السريع
                                                <span>{{ $fast }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-total">
                                        <ul>
                                            <li class="order-total">الإجمالي</li>
                                            <li style="font-size: 20px; color: red;">
                                                <span id="order-total">{{ auth()->user()->cart()->sum('total_cost') }}
                                                </span>رس
                                                <input type="hidden" value="{{ auth()->user()->cart()->sum('total_cost') }}" id="actual-cost"/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="Place-order mt-25">
                                <button type="submit" class="btn-danger" style="height: 60px; width:100%">تاكيد
                                    الطلب</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout area end -->
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.shipment_type').on('click', function() {
                let total = parseInt($('#actual-cost').val());
                if ($(this).val() == 'normal') {
                    let final = total + 50;
                    $('#order-total').text();
                    $('#order-total').text(final);
                } else {
                    let final = total + 100;
                    $('#order-total').text();
                    $('#order-total').text(final);
                }

            });
        });
    </script>
@endsection
