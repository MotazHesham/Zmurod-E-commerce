@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.bank.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.banks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.bank.fields.id') }}
                            </th>
                            <td>
                                {{ $bank->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bank.fields.name') }}
                            </th>
                            <td>
                                {{ $bank->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bank.fields.image') }}
                            </th>
                            <td>
                                @foreach ($bank->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@endsection
