@extends('layouts.admin')
@section('content')
@can('seller_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.sellers.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.seller.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.seller.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Seller">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.seller.fields.id') }}
                    </th>
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
                    <th>
                        {{ trans('cruds.seller.fields.featured_store') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
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
        $.post('{{ route('admin.sellers.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, featured_store:status,  column_name:column_name}, function(data){
            if(data == 1){
                showAlert('success', 'Success', '');
            }else{
                showAlert('danger', 'Something went wrong', '');
            }
        });
    }
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('seller_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sellers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.sellers.index') }}",
    columns: [
        { 
            data: 'placeholder', 
            name: 'placeholder' 
        },

        { 
            data: 'id', 
            name: 'id' 
        },


        { 
            data: 'photo',
            name: 'photo',
            sortable: false, 
            searchable: false 
        },

        { 
            data: 'user.name', 
            name: 'name' 
        },
        { 
            data: 'user.email', 
            name: 'email' 
        },
        { 
            data: 'user.country', 
            name: 'country' 
        },
        { 
            data: 'user.phone', 
            name: 'phone' 
        },

        {     
            data: 'store_name', 
            name: 'store_name' 
        },

        { 
            data: 'featured_store', 
            name: 'featured_store' 
        },

        { 
            data: 'actions', 
            name: '{{ trans('global.actions') }}' 
        }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Seller').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection