@extends('layouts.frontend')
@section('content')

    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">  مستخدم جديد</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
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
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4>تسجيل عميل</h4>
                            </a>
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4>تسجيل  تاجر</h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('frontend.register_customer') }}" method="post">
                                            @csrf
                                            <input type="text" name="name" placeholder="اسم المستخدم" />
                                            <input type="password" name="password" placeholder="كلمة المرور" />
                                            <input name="email" placeholder="البريد الالكتروني" type="email" />
                                            <select name="country"> 
                                                <option value="">اختر المنطقة</option>
                                                @foreach(\App\Models\Order::CITY_SELECT as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="phone" placeholder="رقم الهاتف" />
                                            <div class="button-box">
                                            <button type="submit"><span>تسجيل</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('frontend.register_seller') }}" method="post">
                                            @csrf
                                            <input type="text" name="name" placeholder="اسم المستخدم" />
                                            <input name="email" placeholder="البريد الالكتروني" type="email" />
                                            <input type="password" name="password" placeholder="كلمة المرور" />
                                            <select name="country"> 
                                                <option value="">الدوله</option>
                                                @foreach(\App\Models\Order::CITY_SELECT as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="phone" placeholder="رقم الهاتف" />
                                            <input type="text" name="store_name" placeholder="اسم المتجر" />
                                           
                                            <label class="required" for="photo">{{ trans('cruds.seller.fields.photo') }}</label>
                                            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                                            </div>
                                            @if($errors->has('photo'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('photo') }}
                                                </div>
                                            @endif
                                            <span class="help-block">{{ trans('cruds.seller.fields.photo_helper') }}</span>
                                            
                                            <textarea name="description" placeholder=" تفاصيل عن علاقتك بالمتجر "  > </textarea>
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
        success: function (file, response) {
        $('form').find('input[name="photo"]').remove()
        $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
        },
        removedfile: function (file) {
        file.previewElement.remove()
        if (file.status !== 'error') {
            $('form').find('input[name="photo"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
        }
        },
        init: function () {
        @if(isset($seller) && $seller->photo)
            var file = {!! json_encode($seller->photo) !!}
                this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
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
    <script>
        $(document).ready(function () {
        function SimpleUploadAdapter(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
        return {
            upload: function() {
            return loader.file
                .then(function (file) {
                return new Promise(function(resolve, reject) {
                    // Init request
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route('frontend.sellers.storeCKEditorImages') }}', true);
                    xhr.setRequestHeader('x-csrf-token', window._token);
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.responseType = 'json';

                    // Init listeners
                    var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                    xhr.addEventListener('error', function() { reject(genericErrorText) });
                    xhr.addEventListener('abort', function() { reject() });
                    xhr.addEventListener('load', function() {
                    var response = xhr.response;

                    if (!response || xhr.status !== 201) {
                        return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                    }

                    $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                    resolve({ default: response.url });
                    });

                    if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function(e) {
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
@endsection