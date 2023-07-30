@extends('layouts.seller')
@section('content')

<!-- strat content -->
<div class="bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">
    <!-- start numbers -->
    <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-1">
        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header">المبيعات</div>

            <table class="table-auto w-full text-right">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-r"></th>
                        <th class="px-4 py-2">التاريخ</th>
                        <th class="px-4 py-2 border-r">المنتج</th>
                        <th class="px-4 py-2 border-r">عدد القطع</th>
                        <th class="px-4 py-2 border-r">السعر</th>
                        <th class="px-4 py-2">المستخدم</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                @foreach ($order_products as $order_product )
                    <tr>
                        <td class="border border-l-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i>
                        </td>
                        <td class="border border-l-0 border-r-0 px-4 py-2"> {{$order_product->created_at->format(config('panel.date_format'))}}</td>
                        <td class="border border-l-0 px-4 py-2"> {{$order_product->product->name}}</td>
                        <td class="border border-l-0 px-4 py-2"> {{$order_product->quantity}}</td>
                        <td class="border border-l-0 px-4 py-2">{{$order_product->price * $order_product->quantity }}</td>
                        <td class="border border-l-0 px-4 py-2"> {{$order_product->order->user->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Recent Sales -->


    </div>
    <!-- end nmbers -->
</div>
<!-- end content -->

@endsection