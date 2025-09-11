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
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.identity') }}
                        </th>
                        <td>
                            {!! $seller->user?->identity_number !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.commercial_register') }}
                        </th>
                        <td>
                            {!! $seller->user?->commercial_register !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            نوع الوثيقة
                        </th>
                        <td>
                            @if($seller->document_type)
                                @if($seller->document_type === 'commercial_register')
                                    <span class="badge badge-success">سجل تجاري</span>
                                @else
                                    <span class="badge badge-info">وثيقة عمل حر</span>
                                @endif
                            @else
                                <span class="badge badge-secondary">غير محدد</span>
                            @endif
                        </td>
                    </tr>
                    @if($seller->document_type === 'commercial_register')
                        <tr>
                            <th>
                                صورة السجل التجاري
                            </th>
                            <td>
                                @if($seller->commercial_register_document)
                                    <a href="{{ $seller->commercial_register_document->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $seller->commercial_register_document->getUrl('thumb') }}" style="max-width: 200px;">
                                    </a>
                                @else
                                    <span class="text-muted">لا توجد صورة</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                تاريخ انتهاء السجل التجاري
                            </th>
                            <td>
                                {{ $seller->commercial_register_expiry ? $seller->commercial_register_expiry->format('Y-m-d') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                رقم السجل التجاري
                            </th>
                            <td>
                                {{ $seller->commercial_register_number ?: '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                الرقم الضريبي
                            </th>
                            <td>
                                {{ $seller->tax_number ?: '-' }}
                            </td>
                        </tr>
                    @elseif($seller->document_type === 'freelance_work')
                        <tr>
                            <th>
                                وثيقة العمل الحر
                            </th>
                            <td>
                                @if($seller->freelance_work_document)
                                    <a href="{{ $seller->freelance_work_document->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $seller->freelance_work_document->getUrl('thumb') }}" style="max-width: 200px;">
                                    </a>
                                @else
                                    <span class="text-muted">لا توجد وثيقة</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                رقم المستند
                            </th>
                            <td>
                                {{ $seller->freelance_work_number ?: '-' }}
                            </td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
           
        </div>
    </div>
</div>



@endsection
