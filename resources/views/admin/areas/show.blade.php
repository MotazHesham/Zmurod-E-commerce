@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.area.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.id') }}
                        </th>
                        <td>
                            {{ $area->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.name') }}
                        </th>
                        <td>
                            {{ $area->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.city') }}
                        </th>
                        <td>
                            {{ App\Models\Area::CITY_SELECT[$area->city] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.shipping_cost') }}
                        </th>
                        <td>
                            {{ $area->shipping_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.area.fields.active_area') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $area->active_area ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection