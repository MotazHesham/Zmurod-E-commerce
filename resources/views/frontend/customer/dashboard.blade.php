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
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
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
                            <li> <a href="#orders" data-bs-toggle="tab" class="nav-link">طلباتي</a></li>
                            <li><a href="#courses" data-bs-toggle="tab" class="nav-link">ورش العمل</a></li>
                            <li><a href="#account-details" data-bs-toggle="tab" class="nav-link">تفاصيل الحساب</a>
                            </li>
                            {{-- <li><a href="{{route('frontend.userlogin')}}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">تسجيل الخروج</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        {{-- <div class="tab-pane fade show active" id="dashboard">
                            <h4>لوحة التحكم </h4>
                                <p> Hello This is customer dashboard</p>
                        </div> --}}
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order )
                                        <tr>
                                            <td>{{$order->order_num}}</td>
                                            <td>{{$order->created_at->format(config('panel.date_format'))}}</td>
                                            <td><span class="success">{{$order->delivery_status}}</span></td>
                                            <td>{{$order->total_cost }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="courses">
                            <h4>ورش العمل</h4>
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
                        <div class="tab-pane fade" id="account-details">
                            <h3>تفاصيل الحساب </h3>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                        <form  action="{{ route("customer.customers.update") }}"  method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$customer->user_id}}">
                                            <div class="default-form-box mb-20">
                                                <label>الاسم</label>
                                                <input type="text" name="name" value="{{$customer->user->name}}" readonly>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>البريد الاكتروني</label>
                                                <input type="text" name="email" value="{{$customer->user->email}}" readonly>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>الهاتف المحمول </label>
                                                <input type="text" name="phone" value="{{$customer->user->phone}}" required>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label>العنوان </label>
                                                <input type="text" name="address" value="{{$customer->address}}" required>
                                            </div>
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

@section('scripts')
<script>
    Dropzone.options.personalPhotoDropzone = {
    url: '{{ route('customer.customers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="personal_photo"]').remove()
      $('form').append('<input type="hidden" name="personal_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="personal_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($customer) && $customer->personal_photo)
      var file = {!! json_encode($customer->personal_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="personal_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection