@extends('layouts.seller')
@section('content')
<div class="bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">




    <!-- start numbers -->
    <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-1">



        <!-- Start Recent Sales -->
        <div class="card col-span-2 xl:col-span-1">
            <div class="card-header"> منتجاتي</div>

            <table class="table-auto w-full text-right">
                <thead>
                    <tr>
                        <th class="px-4 py-2">تاريخ الإضافة</th>

                        <th class="px-4 py-2 border-r">صورة المنتج</th>
                        <th class="px-4 py-2 border-r">المنتج</th>
                        <th class="px-4 py-2 border-r">السعر</th>
                        <th class="px-4 py-2 border-r">تعديل</th>

                    </tr>
                </thead>
                <tbody class="text-gray-600">


                    <tr>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2">20 مايو </td>

                        <td class="border border-l-0 px-4 py-2 text-center pro-img "> <img src="img/1.jpg "></td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">كوستر خشبي .</td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">10 ريال</td>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"> تعديل</td>
                    </tr>
                    <tr>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2">20 مايو </td>

                        <td class="border border-l-0 px-4 py-2 text-center pro-img "> <img src="img/1.jpg "></td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">كوستر خشبي .</td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">10 ريال</td>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"> تعديل</td>
                    </tr>
                    <tr>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2">20 مايو </td>

                        <td class="border border-l-0 px-4 py-2 text-center pro-img "> <img src="img/1.jpg "></td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">كوستر خشبي .</td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">10 ريال</td>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"> تعديل</td>
                    </tr>
                    <tr>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2">20 مايو </td>

                        <td class="border border-l-0 px-4 py-2 text-center pro-img "> <img src="img/1.jpg "></td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">كوستر خشبي .</td>
                        <td class="border border-l-0 border-b-0 px-4 py-2">10 ريال</td>
                        <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"> تعديل</td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- End Recent Sales -->


    </div>
    <!-- end nmbers -->

    <!-- end content -->

</div>
@endsection