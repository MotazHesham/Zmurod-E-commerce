@extends('layouts.admin')
@section('content')
@can('banner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banners.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.banner.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.banner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Banner">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.banner.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.banner.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.banner.fields.banner_photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.banner.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $key => $banner)
                        <tr data-entry-id="{{ $banner->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $banner->id ?? '' }}
                            </td>
                            <td>
                                {{ $banner->title ?? '' }}
                            </td>
                            <td>
                                @foreach($banner->banner_photo as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_statuses(this,'active')" value="{{ $banner->id   }}"
                                        type="checkbox" class="c-switch-input"
                                        {{ $banner->active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('banner_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.banners.show', $banner->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('banner_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.banners.edit', $banner->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('banner_delete')
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
    function update_statuses(el,column_name){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('admin.banners.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, active:status, column_name:column_name}, function(data){
            if(data == 1){
                showAlert('success', 'Success', '');
            }else{
                showAlert('danger', 'Something went wrong', '');
            }
        });
    }
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('banner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banners.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Banner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection