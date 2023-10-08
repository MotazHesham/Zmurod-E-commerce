@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.post.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label class="required" for="title">{{ trans('cruds.post.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" id="title" value="{{ old('title', '') }}" required>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required" for="content">{{ trans('cruds.post.fields.content') }}</label>
                        <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.content_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required" for="author_id">{{ trans('cruds.post.fields.author') }}</label>
                        <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}"
                            name="author_id" id="author_id" required>
                            @foreach ($authors as $id => $entry)
                                <option value="{{ $id }}" {{ old('author_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('author'))
                            <div class="invalid-feedback">
                                {{ $errors->first('author') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.author_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label for="post_tags">{{ trans('cruds.post.fields.post_tags') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('post_tags') ? 'is-invalid' : '' }}"
                            name="post_tags[]" id="post_tags" multiple>
                            @foreach ($post_tags as $id => $post_tag)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('post_tags', [])) ? 'selected' : '' }}>{{ $post_tag }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('post_tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('post_tags') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.post_tags_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="photos">{{ trans('cruds.post.fields.photos') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}"
                            id="photos-dropzone">
                        </div>
                        @if ($errors->has('photos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photos') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.photos_helper') }}</span>
                    </div>

                    <div class="form-group col-4">
                        <label class="required" for="post_forum_id">{{ trans('cruds.post.fields.post_forum') }}</label>
                        <select class="form-control select2 {{ $errors->has('post_forum') ? 'is-invalid' : '' }}"
                            name="post_forum_id" id="post_forum_id" required>
                            @foreach ($post_forums as $id => $entry)
                                <option value="{{ $id }}" {{ old('post_forum_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('post_forum'))
                            <div class="invalid-feedback">
                                {{ $errors->first('post_forum') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.post.fields.post_forum_helper') }}</span>
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
        var uploadedPhotosMap = {}
        Dropzone.options.photosDropzone = {
            url: '{{ route('admin.posts.storeMedia') }}',
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
                $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
                uploadedPhotosMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedPhotosMap[file.name]
                }
                $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($post) && $post->photos)
                    var files = {!! json_encode($post->photos) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
@endsection
