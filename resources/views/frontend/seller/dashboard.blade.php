@extends('layouts.seller')
@section('content')




<!-- strat content -->
<div class="bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">


  <!-- General Report -->
  <div class="grid grid-cols-3 gap-6 xl:grid-cols-1">


    <!-- card -->
    <div class="report-card">
      <div class="card">
        <div class="card-body flex flex-col">

          <!-- top -->
          <div class="flex flex-row justify-between items-center">
            <div class="h6 text-indigo-700 fad fa-shopping-cart"></div>

          </div>
          <!-- end top -->

          <!-- bottom -->
          <div class="mt-8">
            <h3 class="h3 "> {{$totalSoldProducts}}</h3>
            <p> منتج تم بيعة</p>
          </div>
          <!-- end bottom -->

        </div>
      </div>
      <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
      <div class="card">
        <div class="card-body flex flex-col">

          <!-- top -->
          <div class="flex flex-row justify-between items-center">
            <div class="h6 text-red-700 fad fa-store">
            </div>
          </div>
          <!-- end top -->

          <!-- bottom -->
          <div class="mt-8">
            <h1 class="h5 ">{{$totalOrders}}</h1>
            <p>اوردر </p>
          </div>
          <!-- end bottom -->

        </div>
      </div>
      <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->


    <!-- card -->
    <div class="report-card">
      <div class="card">
        <div class="card-body flex flex-col">

          <!-- top -->
          <div class="flex flex-row justify-between items-center">
            <div class="h6 text-yellow-600 fad fa-sitemap"></div>

          </div>
          <!-- end top -->
          @php
          $total = 0 ; 
            foreach ($order_products as $order_product) 
            {
              $total += $order_product->quantity ;
            }
          @endphp
          <!-- bottom -->
          <div class="mt-8">
            <h1 class="h5 ">{{$total}}</h1>
            <p>اجمالي المنتجات</p>
          </div>
          <!-- end bottom -->

        </div>
      </div>
      <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
    </div>
    <!-- end card -->





  </div>
  <!-- End General Report -->


  <!-- Sales Overview -->
  <div class="card mt-6">

    <!-- header -->
    <div class="card-header flex flex-row justify-between">
      <h1 class="h6">
        نظرة عامة على المبيعات</h1>

      <div class="flex flex-row justify-center items-center">

        <a href="">
          <i class="fad fa-chevron-double-down mr-6"></i>
        </a>

        <a href="">
          <i class="fad fa-ellipsis-v"></i>
        </a>

      </div>

    </div>
    <!-- end header -->

    <!-- body -->
    <div class="card-body grid grid-cols-2 gap-6 lg:grid-cols-1">

      <div class="p-1">
        <h1 class="h2">5,337</h1>
        <p class="text-black font-medium">مبيعات الشهر</p>

        <div class="mb-2 flex items-center">
          <div class="py-1 px-3 rounded bg-green-200 text-green-900 ml-3">
            <i class="fa fa-caret-up"></i>
          </div>
          <p class="text-black"><span class="num-2 text-green-400"></span><span class="text-green-400">زيادة في
              المبيعات مقارنة بالشهر الماضي.</span> </p>
        </div>

        <div class="flex items-center">
          <div class="py-1 px-3 rounded bg-red-200 text-red-900 ml-3">
            <i class="fa fa-caret-down"></i>
          </div>
          <p class="text-black"><span class="num-2 text-red-400"></span><span class="text-red-400">
              80٪ عائد لكل بيع</span> بالمقارنة مع الشهر الماضي.</p>
        </div>

      </div>

      <div class="">
        <div id="sealsOverview"></div>
      </div>

    </div>
    <!-- end body -->

  </div>
  <!-- end Sales Overview -->

  <!-- start numbers -->
  <div class="grid grid-cols-4 gap-6 xl:grid-cols-2">

    <!-- card -->
    <div class="card mt-6">
      <div class="card-body flex items-center">

        <div class="px-3 py-2 rounded bg-indigo-600 text-white ml-3">
          <i class="fad fa-wallet"></i>
        </div>

        <div class="flex flex-col">
          <h1 class="font-semibold"><span class="num-2"></span> مبيعات</h1>
        </div>

      </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6">
      <div class="card-body flex items-center">

        <div class="px-3 py-2 rounded bg-green-600 text-white ml-3">
          <i class="fad fa-shopping-cart"></i>
        </div>

        <div class="flex flex-col">
          <h1 class="font-semibold"><span class="num-2"></span> اوردر</h1>
        </div>

      </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6 xl:mt-1">
      <div class="card-body flex items-center">

        <div class="px-3 py-2 rounded bg-yellow-600 text-white ml-3">
          <i class="fad fa-blog"></i>
        </div>

        <div class="flex flex-col">
          <h1 class="font-semibold"><span class="num-2"></span> منتج جديد</h1>
        </div>

      </div>
    </div>
    <!-- end card -->

    <!-- card -->
    <div class="card mt-6 xl:mt-1">
      <div class="card-body flex items-center">

        <div class="px-3 py-2 rounded bg-red-600 text-white ml-3">
          <i class="fad fa-comments"></i>
        </div>

        <div class="flex flex-col">
          <h1 class="font-semibold"><span class="num-2"></span> تعليق</h1>
        </div>

      </div>
    </div>
    <!-- end card -->



  </div>
  <!-- end nmbers -->

  <!-- start quick Info -->
  <div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-1">



    <!-- Start Recent Sales -->
    <div class="card col-span-2 xl:col-span-1">
      <div class="card-header">أحدث الاوردرات</div>

      <table class="table-auto w-full text-right">
        <thead>
          <tr>
            <th class="px-4 py-2 border-r"></th>
            <th class="px-4 py-2 border-r">المنتج</th>
            <th class="px-4 py-2 border-r">السعر</th>
            <th class="px-4 py-2">التاريخ</th>
          </tr>
        </thead>
        <tbody class="text-gray-600">

          <tr>
            <td class="border border-l-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i></td>
            <td class="border border-l-0 px-4 py-2">كوستر خشبي</td>
            <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>
          <tr>
            <td class="border border-l-0 px-4 py-2 text-center text-yellow-500"><i class="fad fa-circle"></i></td>
            <td class="border border-l-0 px-4 py-2">حلق خشبي
            </td>
            <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>
          <tr>
            <td class="border border-l-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i></td>
            <td class="border border-l-0 px-4 py-2">كوستر خشبي
            </td>
            <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>
          <tr>
            <td class="border border-l-0 px-4 py-2 text-center text-red-500"><i class="fad fa-circle"></i></td>
            <td class="border border-l-0 px-4 py-2">كوستر خشبي
            </td>
            <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>
          <tr>
            <td class="border border-l-0 px-4 py-2 text-center text-yellow-500"><i class="fad fa-circle"></i></td>
            <td class="border border-l-0 px-4 py-2">مكرمية حائط
            </td>
            <td class="border border-l-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>
          <tr>
            <td class="border border-l-0 border-b-0 px-4 py-2 text-center text-green-500"><i class="fad fa-circle"></i>
            </td>
            <td class="border border-l-0 border-b-0 px-4 py-2">كوستر خشبي .</td>
            <td class="border border-l-0 border-b-0 px-4 py-2">$<span class="num-2"></span></td>
            <td class="border border-l-0 border-b-0 border-r-0 px-4 py-2"><span class="num-2"></span> دقيقة</td>
          </tr>

        </tbody>
      </table>
    </div>
    <!-- End Recent Sales -->


  </div>
  <!-- end quick Info -->


</div>
<!-- end content -->

</div>
<!-- end wrapper -->

@endsection