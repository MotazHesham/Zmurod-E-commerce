@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.seller.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sellers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.id') }}
                        </th>
                        <td>
                            {{ $seller->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.user') }}
                        </th>
                        <td>
                            {{ $seller->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.photo') }}
                        </th>
                        <td>
                            @if($seller->photo)
                                <a href="{{ $seller->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $seller->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.email') }}
                        </th>
                        <td>
                            {{ $seller->user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.country') }}
                        </th>
                        <td>
                            {{ $seller->user->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.phone') }}
                        </th>
                        <td>
                            {{ $seller->user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.store_name') }}
                        </th>
                        <td>
                            {{ $seller->store_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.seller.fields.description') }}
                        </th>
                        <td>
                            {!! $seller->description !!}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sellers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
