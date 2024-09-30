@extends('layouts.admin')
@section('content')
@can('category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.category.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.category.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Category">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.category.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.category.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.category.fields.icon') }}
                        </th>
                        <th>
                            {{ trans('cruds.category.fields.most_recent') }}
                        </th>
                        <th>
                            {{ trans('cruds.category.fields.fav') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr data-entry-id="{{ $category->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $category->id ?? '' }}
                            </td>
                            <td>
                                {{ $category->name ?? '' }}
                            </td>
                            <td>
                                @if($category->icon)
                                    <a href="{{ $category->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $category->icon->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_statuses(this,'most_recent')" value="{{ $category->id   }}"
                                        type="checkbox" class="c-switch-input"
                                        {{ $category->most_recent ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_statuses(this,'fav')" value="{{ $category->id   }}"
                                        type="checkbox" class="c-switch-input"
                                        {{ $category->fav ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                @can('category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.categories.show', $category->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.categories.edit', $category->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('category_delete')
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        $.post('{{ route('admin.categories.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, fav:status, column_name:column_name}, function(data){
            if(data == 1){
                showAlert('success', 'Success', '');
            }else{
                showAlert('danger', 'Something went wrong', '');
            }
        });
        $.post('{{ route('admin.categories.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, most_recent:status, column_name:column_name}, function(data){
            if(data == 1){
                showAlert('success', 'Success', '');
            }else{
                showAlert('danger', 'Something went wrong', '');
            }
        });
    }
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('category_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.massDestroy') }}",
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
  let table = $('.datatable-Category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection