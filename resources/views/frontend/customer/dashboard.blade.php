@extends('layouts.frontend')
@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">الملف الشخصي</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الملف الشخصي</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->




    <!-- account area start -->
    <div class="account-dashboard pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link active">لوحة التحكم</a></li>
                            <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">طلباتي</a></li>
                            <li><a href="#downloads" data-bs-toggle="tab" class="nav-link">الكورسات</a></li>
                            <li><a href="#address" data-bs-toggle="tab" class="nav-link">العنوان</a></li>
                            <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">تفاصيل الحساب</a>
                            </li>
                            <li><a href="{{route('frontend.userlogin')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">تسجيل الخروج</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        <div class="tab-pane fade show active" id="dashboard">
                            <h4>لوحة التحكم </h4>
                                <p> Hello This is customer dashboard</p>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <h4>طلباتي</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>الطلب</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                            <th>الإجمالي</th>
                                            <th>عرض</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>مايو 10, 2023</td>
                                            <td><span class="success">تم التسليم</span></td>
                                            <td>25 رس </td>
                                            <td><a href="cart.html" class="view">عرض</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>مايو 10, 2023</td>
                                            <td><span class="success">تم التسليم</span></td>
                                            <td>25 رس </td>
                                            <td><a href="cart.html" class="view">عرض</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="downloads">
                            <h4>الكورسات</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>اسم الكورس</th>
                                            <th>تاريخ الاشتراك</th>
                                            <th>ينتهي في</th>
                                            <th>التفاصيل</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>تعليم المكرمية</td>
                                            <td>مايو 10, 2023</td>
                                            <td>مايو 10, 2023</td>
                                            <td><a href="#" class="view">التفاصيل</a></td>
                                        </tr>
                                        <tr>
                                            <td>تعليم الكروشية</td>
                                            <td>مايو 10, 2023</td>
                                            <td>مايو 10, 2023</td>
                                            <td><a href="#" class="view">التفاصيل</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="address">
                            <p>The following addresses will be used on the checkout page by default.</p>
                            <h5 class="billing-address"> عنوان الشحن</h5>
                            <a href="#" class="view">تعديل</a>
                            <p class="mb-2"><strong>حي الياسمين</strong></p>
                            <address>
                                <span class="mb-1 d-inline-block"><strong>المدينة:</strong> الرياض</span>,
                                <br>
                                <span class="mb-1 d-inline-block"><strong>البلد:</strong> المملكة العربية السعودبة</span>,
                                <br>
                                <span class="mb-1 d-inline-block"><strong>الرمز البريدي:</strong> 98101</span>,
                            </address>
                        </div>
                        <div class="tab-pane fade" id="account-details">
                            <h3>تفاصيل الحساب </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form action="#">

                                            <div class="default-form-box mb-20">
                                                <label>الاسم الاول</label>
                                                <input type="text" name="first-name">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>الاسم الاخير</label>
                                                <input type="text" name="last-name">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>البريد الاكتروني</label>
                                                <input type="text" name="email-name">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>كلمة المرور</label>
                                                <input type="password" name="user-password">
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>تاريخ الميلاد</label>
                                                <input type="date" name="birthday">
                                            </div>
                                            <span class="example">
                                                (E.g.: 05/31/1970)
                                            </span>
                                            <br>

                                            <div class="save_button mt-3">
                                                <button class="btn" type="submit">حفظ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- account area start -->

@endsection
