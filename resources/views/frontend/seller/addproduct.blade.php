@extends('layouts.seller')
@section('content')
<!-- strat content -->
<div class="bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">




    <!-- start numbers -->
    <div class="grid grid-cols-2 gap-6 xl:grid-cols-1">



        <!-- card -->
        <div class="addpro">
            <div class=" mt-6 ">
                <label>كود المنتج</label>
                <br />
                <input name="name" placeholder="الاسم*" type="text" class="mt-3">
            </div>
        </div>
        <!-- end card -->
        <!-- card -->
        <div class="addpro">
            <div class=" mt-6 ">
                <label>اسم المنتج</label>
                <br />
                <input name="name" placeholder="الاسم*" type="text" class="mt-3">
            </div>
        </div>
        <!-- end card -->



        <!-- card -->
        <div class="addpro">
            <label>التصنيف </label>
            <br />
            <select name="languages" id="lang">
                <option value="javascript">خيوط</option>
                <option value="php">زجاج</option>
                <option value="java">جلود</option>
                <option value="golang">إكسسوارات</option>
                <option value="python">خشب</option>
                <option value="c#">فنون#</option>
                <option value="C++">خزف</option>
            </select>

        </div>
        <!-- end card -->
        <!-- card -->
        <div class="addpro">

            <label> وصف المنتج</label>
            <br />
            <input name="name" placeholder="وصف المنتج
               *" type="text">

        </div>
        <!-- end card -->


        <!-- card -->
        <div class="addpro">

            <label> الإتاحة</label>
            <br />
            <select name="languages" id="lang">
                <option value="yes">متاح</option>
                <option value="no">غير متاح</option>

            </select>


        </div>
        <!-- end card -->


        <div class="addpro">

            <label> السعر</label>
            <br />
            <input name="name" placeholder="السعر*" type="text">

        </div>
        <!-- end card -->
        <!-- card -->
        <div class="addpro">

            <label> صور المنتج</label>
            <br />
            <input type="file" id="myfile" name="myfile">

        </div>
        <!-- end card -->


        <div class="addpro">

            <label> خيارات الشحن</label>
            <br />
            <select name="languages" id="lang">
                <option value="yes">الشحن من خلال حراير</option>
                <option value="no"> الشحن من خلال البائع</option>

            </select>
        </div>
        <!-- end card -->
    </div>
    <!-- end nmbers -->

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-10">
        <a href="#" class="btn-bs-dark mr-6 lg:mr-0 lg:mb-6"> تحميل المنتج</a>


    </div>
    <!-- end content -->

</div>
@endsection