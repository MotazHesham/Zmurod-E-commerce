@extends('layouts.frontend')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title"> مستخدم جديد</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active">دخول</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->



    <!-- login area start -->
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a data-bs-toggle="tab" href="#lg1">
                                <h4>تسجيل عميل</h4>
                            </a>
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4>تسجيل تاجر</h4>
                            </a>
                        </div>

                        <div class="tab-content">
                            @if ($errors->count() > 0)
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div id="lg1" class="tab-pane active @if (
                                $errors->hasAny([
                                    'customer_name',
                                    'customer_password',
                                    'customer_country',
                                    'customer_region',
                                    'customer_complete-add',
                                    'customer_phone',
                                ])) ) active @endif">

                                <div class="login-form-container">
                                    <h4 class="text-center">بيانات العميل</h4>
                                    <div class="login-register-form">
                                        <form action="{{ route('frontend.register_customer') }}" method="post"
                                            id="custome-form">
                                            @csrf
                                            <input
                                                class="form-control {{ $errors->has('customer_name') ? 'is-invalid' : '' }}"
                                                type="text" name="customer_name" id="customer_name"
                                                value="{{ old('customer_name', '') }}" placeholder="أسم المستخدم" required>
                                            @if ($errors->has('customer_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_name') }}
                                                </div>
                                            @endif
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                type="email" name="email" value="{{ old('email') }}"
                                                placeholder="البريد الالكتروني" required>
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                            <input
                                                class="form-control {{ $errors->has('customer_password') ? 'is-invalid' : '' }}"
                                                type="password" name="customer_password" placeholder="كلمة المرور" required>
                                            @if ($errors->has('customer_password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_password') }}
                                                </div>
                                            @endif
                                            <select name="customer_country">
                                                <option value=""> الدوله</option>
                                                @foreach (\App\Models\User::CITY_SELECT as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (old('customer_country') == $key) selected @endif>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <select name="customer_region" required>
                                                <option value="">المحافظه / المنطقه </option>
                                                @foreach (\App\Models\User::AREA_SELECT as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (old('customer_region') == $key) selected @endif>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="customer_complete-add" placeholder="اسم الشارع"
                                                required />
                                            <input
                                                class="form-control {{ $errors->has('customer_phone') ? 'is-invalid' : '' }} customer_phone"
                                                type="tel" name="customer_phone" id="customer_phone"
                                                placeholder="رقم الهاتف" value="{{ old('customer_phone', '') }}" required>
                                            @if ($errors->has('customer_phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('customer_phone') }}
                                                </div>
                                            @endif
                                            <div class="button-box">
                                                <button type="submit"><span>تسجيل</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="lg2" class="tab-pane @if (
                                $errors->hasAny([
                                    'name',
                                    'password',
                                    'country',
                                    'region',
                                    'complete-add',
                                    'phone',
                                    'store_name',
                                    'description',
                                    'photo',
                                ])) ) active @endif">

                                <div class="login-form-container">
                                    <h4 class="text-center">بيانات التاجر</h4>
                                    <div class="login-register-form">
                                        <form action="{{ route('frontend.register_seller') }}" id="seller-form"
                                            method="post">
                                            @csrf
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                type="text" name="name" id="name" value="{{ old('name', '') }}"
                                                placeholder="أسم المستخدم" required>
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                type="email" name="email" value="{{ old('email') }}"
                                                placeholder="البريد الالكتروني" required>
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                type="password" name="password" id="password" placeholder="كلمة المرور"
                                                required>
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                            <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}"
                                                type="text" name="identity_number" id="identity_number" placeholder="رقم الهوية"
                                                required>
                                            @if ($errors->has('identity_number'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('identity_number') }}
                                                </div>
                                            @endif
                                            <input class="form-control {{ $errors->has('commercial_register') ? 'is-invalid' : '' }}"
                                            type="text" name="commercial_register" id="commercial_register" placeholder="رقم السجل التجاري"
                                            required>
                                        @if ($errors->has('commercial_register'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('commercial_register') }}
                                            </div>
                                        @endif
                                            <select name="type" id="type" >
                                                <option>نوع الكيان</option>
                                                <option value="individual">فرد</option>
                                                <option value="oragainzation">مؤسسة</option>
                                            </select>
                                            <select name="organization_id" id="oragainzation-select" class="d-none">
                                                <option value="">أختر المؤسسة التابع لها  </option>
                                                @foreach ($organizations as $organization)
                                                    <option value="{{ $organization->id }}">{{ $organization->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select name="country" required>
                                                <option value="">الدوله</option>
                                                @foreach (\App\Models\User::CITY_SELECT as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (old('country') == $key) selected @endif>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('country') }}
                                                </div>
                                            @endif
                                            <select name="region" required>
                                                <option value="">المحافظه / المنطقه </option>
                                                @foreach (\App\Models\User::AREA_SELECT as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if (old('region') == $key) selected @endif>
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="complete-add" placeholder="اسم الشارع"
                                                required />
                                            <input
                                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} customer_phone"
                                                type="tel" name="phone" id="phone" placeholder="رقم الهاتف"
                                                value="{{ old('phone', '') }}" required>
                                            @if ($errors->has('phone'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </div>
                                            @endif
                                            <input
                                                class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}"
                                                type="text" name="store_name" id="store_name"
                                                value="{{ old('store_name', '') }}" placeholder="اسم المتجر" required>
                                            @if ($errors->has('store_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('store_name') }}
                                                </div>
                                            @endif

                                            <label class="required"
                                                for="photo">{{ trans('cruds.seller.fields.photo') }}</label>
                                            <div class="needsclick dropzone style--three {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                                                id="photo-dropzone">
                                            </div>
                                            @if ($errors->has('photo'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('photo') }}
                                                </div>
                                            @endif
                                            <label class="required" for="description">التفاصيل</label>
                                            <textarea id="description" name="description" rows="4" cols="50" required></textarea>
                                            <div class="button-box">
                                                <button type="submit"><span>تسجيل</span></button>
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
    <!-- login area end -->
@endsection
@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('frontend.sellers.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($seller) && $seller->photo)
                    var file = {!! json_encode($seller->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
    <script>
        $(document).ready(function() {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('frontend.sellers.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $seller->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var $sellerTab = $('#lg2'); // Use jQuery selector to select the seller tab
            var $customerTab = $('#lg1'); // Use jQuery selector to select the customer tab

            @if (
                $errors->hasAny([
                    'name',
                    'email',
                    'password',
                    'country',
                    'region',
                    'complete-add',
                    'phone',
                    'store_name',
                    'description',
                    'photo',
                ]))
                // If there are errors in seller registration fields, show the "تسجيل تاجر" tab
                $sellerTab.addClass('active show');
                $customerTab.removeClass('active show');
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("regex", function(value, element, regexpr) {
                return this.optional(element) || regexpr.test(value);
            }, "Invalid input.");
            $("#seller-form").validate({
                rules: {
                    customer_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10
                    },
                    country: {
                        required: true
                    },
                    commercial_register:{
                        required:true
                    },
                    identity:{
                        required:true
                    },
                    region: {
                        required: true
                    },
                    store_name: {
                        required: true,
                        minlength: 4,
                        maxlength: 30,
                        regex: /^[a-zA-Z][a-zA-Z0-9_]*$/ // تعبير منتظم للتحقق من الشرط المطلوب
                    }
                },
                messages: {
                    customer_name: {
                        required: "الاسم مطلوب",
                        minlength: "الاسم يجب أن يحتوي على 3 أحرف على الأقل"
                    },
                    email: {
                        required: "البريد الالكتروني مطلوب",
                        email: "يرجى إدخال بريد إلكتروني صحيح"
                    },
                    customer_password: {
                        required: "كلمة المرور مطلوبة",
                        minlength: "كلمة المرور يجب أن تكون 6 أحرف على الأقل"
                    },
                    customer_phone: {
                        required: "رقم الهاتف مطلوب",
                        digits: "يرجى إدخال أرقام فقط",
                        minlength: "رقم الهاتف يجب أن يكون على الأقل 10 أرقام"
                    },
                    customer_country: {
                        required: "يرجى اختيار الدولة"
                    },
                    customer_region: {
                        required: "يرجى اختيار المنطقة"
                    },
                    store_name: {
                        required: "اسم المتجر مطلوب",
                        minlength: "الاسم يجب أن يحتوي على 4 أحرف على الأقل",
                        maxlength: "الاسم يجب أن لا يزيد عن 30 حرفًا",
                        regex: "يجب أن يبدأ الاسم بحرف أبجدي، ويمكن أن يحتوي على أحرف، أرقام، أو شرطة سفلية فقط"
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-control").addClass("is-invalid");
                    error.insertAfter(element);
                },
                success: function(label, element) {
                    $(element).removeClass("is-invalid");
                    $(element).closest(".form-control").addClass("is-valid");
                },
                highlight: function(element) {
                    $(element).closest(".form-control").addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                    $(element).addClass("is-valid");
                }
            });

            // الفاليديشن عند مغادرة الحقل
            $("input, select").on("blur", function() {
                $(this).valid();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#custome-form").validate({
                rules: {
                    customer_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    customer_password: {
                        required: true,
                        minlength: 6
                    },
                    customer_phone: {
                        required: true,
                        digits: true,
                        minlength: 10
                    },
                    customer_country: {
                        required: true
                    },
                    customer_region: {
                        required: true
                    },
                },
                messages: {
                    customer_name: {
                        required: "الاسم مطلوب",
                        minlength: "الاسم يجب أن يحتوي على 3 أحرف على الأقل"
                    },
                    email: {
                        required: "البريد الالكتروني مطلوب",
                        email: "يرجى إدخال بريد إلكتروني صحيح"
                    },
                    customer_password: {
                        required: "كلمة المرور مطلوبة",
                        minlength: "كلمة المرور يجب أن تكون 6 أحرف على الأقل"
                    },
                    customer_phone: {
                        required: "رقم الهاتف مطلوب",
                        digits: "يرجى إدخال أرقام فقط",
                        minlength: "رقم الهاتف يجب أن يكون على الأقل 10 أرقام"
                    },
                    customer_country: {
                        required: "يرجى اختيار الدولة"
                    },
                    customer_region: {
                        required: "يرجى اختيار المنطقة"
                    },
                },
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-control").addClass("is-invalid");
                    error.insertAfter(element);
                },
                success: function(label, element) {
                    $(element).removeClass("is-invalid");
                    $(element).closest(".form-control").addClass("is-valid");
                },
                highlight: function(element) {
                    $(element).closest(".form-control").addClass("is-invalid");
                },
                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                    $(element).addClass("is-valid");
                }
            });

            // الفاليديشن عند مغادرة الحقل
            $("input, select").on("blur", function() {
                $(this).valid();
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var inputs = document.querySelectorAll(".customer_phone");

            inputs.forEach(function(input) {
                window.intlTelInput(input, {
                    initialCountry: "sa",
                    preferredCountries: ["sa", "eg", "ae", "kw"],
                    separateDialCode: true,
                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                });
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#type').on('change',function(){
                if($(this).val() == 'oragainzation'){
                    $('#oragainzation-select').removeClass('d-none');
                }
                else{
                    $('#oragainzation-select').addClass('d-none');

                }
            });
        })
        </script>
@endsection
