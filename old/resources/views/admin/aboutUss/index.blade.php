@extends('layouts.admin')
@section('content') 
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.aboutUs.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-AboutUs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.aboutUs.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.aboutUs.fields.logo') }}
                            </th>
                            <th>
                                {{ trans('cruds.aboutUs.fields.normal_shipment_cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.aboutUs.fields.fast_shipment_cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.aboutUs.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aboutUss as $key => $aboutUs)
                            <tr data-entry-id="{{ $aboutUs->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $aboutUs->id ?? '' }}
                                </td>
                                <td>
                                    @if ($aboutUs->logo)
                                        <a href="{{ $aboutUs->logo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $aboutUs->logo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $aboutUs->normal_shipment_cost ?? '' }}
                                </td>
                                <td>
                                    {{ $aboutUs->fast_shipment_cost ?? '' }}
                                </td>
                                <td>
                                    {{ $aboutUs->name ?? '' }}
                                </td>
                                <td>

                                    @can('about_us_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.about-uss.edit', $aboutUs->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-AboutUs:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
