@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="icon">{{ trans('cruds.category.fields.icon') }}</label>
                <div class="needsclick dropzone {{ $errors->has('icon') ? 'is-invalid' : '' }}" id="icon-dropzone">
                </div>
                @if($errors->has('icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.icon_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('most_recent') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="most_recent" value="0">
                    <input class="form-check-input" type="checkbox" name="most_recent" id="most_recent" value="1" {{ $category->most_recent || old('most_recent', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="most_recent">{{ trans('cruds.category.fields.most_recent') }}</label>
                </div>
                @if($errors->has('most_recent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('most_recent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.most_recent_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('fav') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="fav" value="0">
                    <input class="form-check-input" type="checkbox" name="fav" id="fav" value="1" {{ $category->fav || old('fav', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fav">{{ trans('cruds.category.fields.fav') }}</label>
                </div>
                @if($errors->has('fav'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fav') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.category.fields.fav_helper') }}</span>
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
    Dropzone.options.iconDropzone = {
    url: '{{ route('admin.categories.storeMedia') }}',
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
      $('form').find('input[name="icon"]').remove()
      $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="icon"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($category) && $category->icon)
      var file = {!! json_encode($category->icon) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
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