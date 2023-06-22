@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="client_name">{{ trans('cruds.order.fields.client_name') }}</label>
                <input class="form-control {{ $errors->has('client_name') ? 'is-invalid' : '' }}" type="text" name="client_name" id="client_name" value="{{ old('client_name', '') }}" required>
                @if($errors->has('client_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.client_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.order.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number_2">{{ trans('cruds.order.fields.phone_number_2') }}</label>
                <input class="form-control {{ $errors->has('phone_number_2') ? 'is-invalid' : '' }}" type="text" name="phone_number_2" id="phone_number_2" value="{{ old('phone_number_2', '') }}" required>
                @if($errors->has('phone_number_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.phone_number_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shipping_address">{{ trans('cruds.order.fields.shipping_address') }}</label>
                <textarea class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}" name="shipping_address" id="shipping_address" required>{{ old('shipping_address') }}</textarea>
                @if($errors->has('shipping_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipping_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.order.fields.delivery_status') }}</label>
                <select class="form-control {{ $errors->has('delivery_status') ? 'is-invalid' : '' }}" name="delivery_status" id="delivery_status" required>
                    <option value disabled {{ old('delivery_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Order::DELIVERY_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery_status', 'pending') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('delivery_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.delivery_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="discount">{{ trans('cruds.order.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', '') }}" step="0.01">
                @if($errors->has('discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.order.fields.shipment_type') }}</label>
                @foreach(App\Models\Order::SHIPMENT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('shipment_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="shipment_type_{{ $key }}" name="shipment_type" value="{{ $key }}" {{ old('shipment_type', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="shipment_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('shipment_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipment_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.shipment_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="area_code">{{ trans('cruds.order.fields.area_code') }}</label>
                <input class="form-control {{ $errors->has('area_code') ? 'is-invalid' : '' }}" type="text" name="area_code" id="area_code" value="{{ old('area_code', '') }}" required>
                @if($errors->has('area_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.area_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.order.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.user_helper') }}</span>
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