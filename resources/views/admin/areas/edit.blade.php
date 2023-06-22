@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.area.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.areas.update", [$area->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.area.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $area->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.area.fields.city') }}</label>
                <select class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city" id="city" required>
                    <option value disabled {{ old('city', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Area::CITY_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('city', $area->city) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_cost">{{ trans('cruds.area.fields.shipping_cost') }}</label>
                <input class="form-control {{ $errors->has('shipping_cost') ? 'is-invalid' : '' }}" type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $area->shipping_cost) }}" step="0.01" required>
                @if($errors->has('shipping_cost'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_cost') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.shipping_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active_area') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="active_area" id="active_area" value="1" {{ $area->active_area || old('active_area', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="active_area">{{ trans('cruds.area.fields.active_area') }}</label>
                </div>
                @if($errors->has('active_area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active_area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.area.fields.active_area_helper') }}</span>
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