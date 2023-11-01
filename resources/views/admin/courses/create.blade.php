@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-4">
                        <label class="required" for="name">{{ trans('cruds.course.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required" for="trainer">{{ trans('cruds.course.fields.trainer') }}</label>
                        <input class="form-control {{ $errors->has('trainer') ? 'is-invalid' : '' }}" type="text"
                            name="trainer" id="trainer" value="{{ old('trainer', '') }}" required>
                        @if ($errors->has('trainer'))
                            <div class="invalid-feedback">
                                {{ $errors->first('trainer') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.trainer_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required" for="start_at">{{ trans('cruds.course.fields.start_at') }}</label>
                        <input class="form-control date {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text"
                            name="start_at" id="start_at" value="{{ old('start_at') }}" required>
                        @if ($errors->has('start_at'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_at') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.start_at_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-5">
                        <label class="required" for="description">{{ trans('cruds.course.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                            id="description" required>{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group col-5">
                        <label for="photo">{{ trans('cruds.course.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.photo_helper') }}</span>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="form-group col-4">
                        <label for="price">{{ trans('cruds.course.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label for="courses_hours">{{ trans('cruds.course.fields.courses_hours') }}</label>
                        <input class="form-control {{ $errors->has('courses_hours') ? 'is-invalid' : '' }}" type="number"
                            name="courses_hours" id="courses_hours" value="{{ old('courses_hours', '') }}" step="0.01">
                        @if ($errors->has('courses_hours'))
                            <div class="invalid-feedback">
                                {{ $errors->first('courses_hours') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.courses_hours_helper') }}</span>
                    </div>
                    <div class="form-group col-4">
                        <label class="required">{{ trans('cruds.course.fields.type') }}</label>
                        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type"
                            id="type" required>
                            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Course::TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <div class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.course.fields.type_helper') }}</span>
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
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.courses.storeMedia') }}',
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
                @if (isset($course) && $course->photo)
                    var file = {!! json_encode($course->photo) !!}
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
@endsection
