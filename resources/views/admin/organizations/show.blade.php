@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.organization.title') }}
        </div>



        <div class="card-body">

            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                            <div class="text-value">{{ $total_users }}</div>
                            <div>التجار المسجلين</div>
                            <br />
                        </div>
                    </div>
                </div>
                @if ($users->count() > 0)
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Seller">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.seller.fields.photo') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seller.fields.name') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seller.fields.email') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seller.fields.country') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seller.fields.phone') }}
                                </th>
                                <th>
                                    {{ trans('cruds.seller.fields.store_name') }}
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <td>{{ $user->photo }}</td>
                                <td>{{ $user->user->name }}</td>
                                <td>{{ $user->user->email }}</td>
                                <td>{{ $user->user->country }}</td>
                                <td>{{ $user->user->phone }}</td>
                                <td>{{ $user->store_name }}</td>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.id') }}
                            </th>
                            <td>
                                {{ $organization->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.user') }}
                            </th>
                            <td>
                                {{ $organization->user->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.photo') }}
                            </th>
                            <td>
                                @if ($organization->photo)
                                    <a href="{{ $organization->photo->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $organization->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.email') }}
                            </th>
                            <td>
                                {{ $organization->user->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.country') }}
                            </th>
                            <td>
                                {{ $organization->user->country }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.phone') }}
                            </th>
                            <td>
                                {{ $organization->user->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.organization.fields.description') }}
                            </th>
                            <td>
                                {!! $organization->description !!}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
