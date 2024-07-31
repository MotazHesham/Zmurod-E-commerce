@extends('layouts.seller')
@section('content')
<!-- strat content -->
<div class=" card-body bg-gray-100 flex-1 p-6 md:mt-16" style="direction: rtl;">

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <h3>تفاصيل الحساب </h3>
        <div class="login">
            <div class="login_form_container">
                <div class="account_login_form">
                    <form  action="{{ route("seller.profile.update") }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                        <div class="default-form-box mb-3">
                            <label>الاسم</label>
                            <input type="text" name="name" value="{{ Auth::user()->name}}" readonly>
                        </div>
                        <div class="default-form-box mb-3">
                            <label>البريد الاكتروني</label>
                            <input type="text" name="email" value="{{ Auth::user()->email}}" readonly>
                        </div>
                        <div class="default-form-box mb-3">
                            <label>الهاتف المحمول </label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone}}" required>
                        </div>
                        <div class="default-form-box mb-3">
                            <label>العنوان </label>
                            <input type="text" name="address" value="{{ Auth::user()->address}}" required>
                        </div>
                        <div class="grid grid-cols-1 gap-6 xl:grid-cols-1 mt-10">
                            <button type="submit" class=" btn-bs-dark mr-6 lg:mr-0 lg:mb-6"> حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>


</div>
@endsection

@section('scripts')
<script>
        var uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
        url: '{{ route('seller.products.storeMedia') }}',
        maxFilesize: 2, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
        $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
        uploadedImageMap[file.name] = response.name
        },
        removedfile: function (file) {
        console.log(file)
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedImageMap[file.name]
        }
        $('form').find('input[name="image[]"][value="' + name + '"]').remove()
        },
        init: function () {
        @if(isset($product) && $product->image)
        var files = {!! json_encode($product->image) !!}
            for (var i in files) {
            var file = files[i]
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
            }
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