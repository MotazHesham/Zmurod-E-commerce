@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aboutUs.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.about-uss.update", [$aboutUs->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="vision">{{ trans('cruds.aboutUs.fields.vision') }}</label>
                <textarea class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision" id="vision">{{ old('vision', $aboutUs->vision) }}</textarea>
                @if($errors->has('vision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.vision_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.aboutUs.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $aboutUs->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number">{{ trans('cruds.aboutUs.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $aboutUs->phone_number) }}">
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_number_2">{{ trans('cruds.aboutUs.fields.phone_number_2') }}</label>
                <input class="form-control {{ $errors->has('phone_number_2') ? 'is-invalid' : '' }}" type="text" name="phone_number_2" id="phone_number_2" value="{{ old('phone_number_2', $aboutUs->phone_number_2) }}">
                @if($errors->has('phone_number_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.phone_number_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.aboutUs.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="normal_shipment_cost">{{ trans('cruds.aboutUs.fields.normal_shipment_cost') }}</label>
                <input class="form-control {{ $errors->has('normal_shipment_cost') ? 'is-invalid' : '' }}" type="number" name="normal_shipment_cost" id="normal_shipment_cost" value="{{ old('normal_shipment_cost', $aboutUs->normal_shipment_cost) }}" step="0.01" required>
                @if($errors->has('normal_shipment_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('normal_shipment_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.normal_shipment_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fast_shipment_cost">{{ trans('cruds.aboutUs.fields.fast_shipment_cost') }}</label>
                <input class="form-control {{ $errors->has('fast_shipment_cost') ? 'is-invalid' : '' }}" type="number" name="fast_shipment_cost" id="fast_shipment_cost" value="{{ old('fast_shipment_cost', $aboutUs->fast_shipment_cost) }}" step="0.01" required>
                @if($errors->has('fast_shipment_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fast_shipment_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.fast_shipment_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.aboutUs.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $aboutUs->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.aboutUs.fields.name_helper') }}</span>
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
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.about-uss.storeMedia') }}',
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
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($aboutUs) && $aboutUs->logo)
      var file = {!! json_encode($aboutUs->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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