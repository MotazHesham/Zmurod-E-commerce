@extends('layouts.admin')
@section('content')
    <div class="card ">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.blog.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label class="required" for="user_id">{{ trans('cruds.blog.fields.user') }}</label>
                        <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id"
                            id="user_id" required>
                            @foreach ($users as $id => $entry)
                                <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('user'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.user_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="media_url">{{ trans('cruds.blog.fields.media_url') }}</label>
                        <input class="form-control {{ $errors->has('media_url') ? 'is-invalid' : '' }}" type="text"
                            name="media_url" id="media_url" value="{{ old('media_url', '') }}">
                        @if ($errors->has('media_url'))
                            <div class="invalid-feedback">
                                {{ $errors->first('media_url') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.media_url_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required">{{ trans('cruds.blog.fields.type') }}</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type"
                            id="type" required>
                            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Blog::TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('type', '') === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.type_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label class="required" for="title">{{ trans('cruds.blog.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" id="title" value="{{ old('title', '') }}" required>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="content">{{ trans('cruds.blog.fields.content') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"
                            id="content">{!! old('content') !!}</textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.content_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required"
                            for="short_description">{{ trans('cruds.blog.fields.short_description') }}</label>
                        <textarea class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}" name="short_description"
                            id="short_description" required>{{ old('short_description') }}</textarea>
                        @if ($errors->has('short_description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('short_description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.short_description_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="form-group col-4">
                        <label for="photo">{{ trans('cruds.blog.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="video">{{ trans('cruds.blog.fields.video') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}"
                            id="video-dropzone">
                        </div>
                        @if ($errors->has('video'))
                            <div class="invalid-feedback">
                                {{ $errors->first('video') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.video_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="tags">{{ trans('cruds.blog.fields.tags') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]"
                            id="tags" multiple>
                            @foreach ($tags as $id => $tag)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.blog.fields.tags_helper') }}</span>
                    </div>
                </div>


                <div class="form-group row justify-content-center">
                    <button class="btn btn-danger col-5" type="submit">
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
                                            '{{ route('admin.blogs.storeCKEditorImages') }}',
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
                                        data.append('crud_id', '{{ $blog->id ?? 0 }}');
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
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.blogs.storeMedia') }}',
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
                @if (isset($blog) && $blog->photo)
                    var file = {!! json_encode($blog->photo) !!}
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
        Dropzone.options.videoDropzone = {
            url: '{{ route('admin.blogs.storeMedia') }}',
            maxFilesize: 5, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5
            },
            success: function(file, response) {
                $('form').find('input[name="video"]').remove()
                $('form').append('<input type="hidden" name="video" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="video"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($blog) && $blog->video)
                    var file = {!! json_encode($blog->video) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="video" value="' + file.file_name + '">')
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
