@extends('layouts.seller')
@section('content')
    <div class="bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">
        <!-- start numbers -->
        <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-1">
            <!-- Start Recent Sales -->
            <div class="card col-span-2 xl:col-span-1 overflow-auto">
                <div class="card-header"> منتجاتي</div>

                <table class="table-auto w-full text-right">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">تاريخ الإضافة</th>

                            <th class="px-4 py-2 border-r">صورة المنتج</th>
                            <th class="px-4 py-2 border-r">المنتج</th>
                            <th class="px-4 py-2 border-r">السعر</th>
                            <th class="px-4 py-2 border-r">الموافقه من الاداره </th>
                            <th class="px-4 py-2 border-r">تعديل</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($products as $product)
                            <tr>
                                <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2">
                                    {{ $product->created_at->format(config('panel.date_format')) }}</td>
                                <td class="border border-l-0 px-4 py-2 text-center pro-img ">
                                    @if ($product->image != null)
                                        @foreach ($product->image as $key => $media)
                                            <img src="{{ $media->getUrl() }}">
                                        @endforeach
                                    @endif

                                </td>
                                <td class="border border-l-0 border-b-0 px-4 py-2">{{ $product->name }}</td>
                                <td class="border border-l-0 border-b-0 px-4 py-2">{{ $product->price }}</td>
                                <td class="border border-l-0 border-b-0 px-4 py-2">
                                    {{ $product->published ? 'accepted' : 'pending' }}</td>
                                <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"> <a
                                        href="{{ route('seller.products.edit', $product->id) }}"><button
                                            class="btn btn-danger"> تعديل </button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Recent Sales -->


        </div>
        <!-- end nmbers -->

        <!-- end content -->

    </div>
@endsection
