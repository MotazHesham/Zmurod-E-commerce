@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="shipping_method" value="hrayer">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                            id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required"
                            for="product_category_id">{{ trans('cruds.product.fields.product_category') }}</label>
                        <select class="form-control select2 {{ $errors->has('product_category') ? 'is-invalid' : '' }}"
                            name="product_category_id" id="product_category_id" required>
                            @foreach ($product_categories as $id => $entry)
                                <option value="{{ $id }}" {{ old('product_category_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_category'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_category') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.product_category_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="price">{{ trans('cruds.product.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="discount">{{ trans('cruds.product.fields.discount') }}</label>
                        <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number"
                            name="discount" id="discount" value="{{ old('discount', '') }}" step="0.01">
                        @if ($errors->has('discount'))
                            <div class="invalid-feedback">
                                {{ $errors->first('discount') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.discount_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="discount">{{ trans('cruds.product.fields.weight') }}</label>
                        <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number"
                            name="weight" id="weight" value="{{ old('discount', '') }}" step="0.01">
                        @if ($errors->has('weight'))
                            <div class="invalid-feedback">
                                {{ $errors->first('discount') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.weight_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="current_stock">{{ trans('cruds.product.fields.current_stock') }}</label>
                        <input class="form-control {{ $errors->has('current_stock') ? 'is-invalid' : '' }}" type="number"
                            name="current_stock" id="current_stock" value="{{ old('current_stock', '') }}" step="1"
                            required>
                        @if ($errors->has('current_stock'))
                            <div class="invalid-feedback">
                                {{ $errors->first('current_stock') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.current_stock_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="product_tags">{{ trans('cruds.product.fields.product_tags') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('product_tags') ? 'is-invalid' : '' }}"
                            name="product_tags[]" id="product_tags" multiple>
                            @foreach ($product_tags as $id => $product_tag)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('product_tags', [])) ? 'selected' : '' }}>{{ $product_tag }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_tags') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.product_tags_helper') }}</span>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="product_offers">{{ trans('cruds.product.fields.product_offers') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('product_offers') ? 'is-invalid' : '' }}"
                            name="product_offers[]" id="product_offers" multiple>
                            @foreach ($product_offers as $id => $product_offer)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('product_offers', [])) ? 'selected' : '' }}>{{ $product_offer }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_offers'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_offers') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.product_offers_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                        </div>
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="information">{{ trans('cruds.product.fields.information') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('information') ? 'is-invalid' : '' }}" name="information"
                            id="information">{!! old('information') !!}</textarea>
                        @if ($errors->has('information'))
                            <div class="invalid-feedback">
                                {{ $errors->first('information') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.information_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label  for="file">{{ trans('cruds.product.fields.file') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                        </div>
                        @if ($errors->has('file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('file') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
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
                                            '{{ route('admin.products.storeCKEditorImages') }}',
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
                                        data.append('crud_id', '{{ $product->id ?? 0 }}');
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
        var uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function(file) {
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
            init: function() {
                @if (isset($product) && $product->image)
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
        Dropzone.options.fileDropzone = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="file"]').remove()
                $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($product) && $product->file)
                    var file = {!! json_encode($product->file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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
@endsection
