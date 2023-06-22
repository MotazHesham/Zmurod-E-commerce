@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.froum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.froums.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.froum.fields.id') }}
                        </th>
                        <td>
                            {{ $froum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.froum.fields.name') }}
                        </th>
                        <td>
                            {{ $froum->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.froum.fields.description') }}
                        </th>
                        <td>
                            {!! $froum->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.froum.fields.category') }}
                        </th>
                        <td>
                            {{ App\Models\Froum::CATEGORY_SELECT[$froum->category] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.froums.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection