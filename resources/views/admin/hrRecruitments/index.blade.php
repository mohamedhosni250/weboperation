@extends('layouts.admin')
@section('content')
<div class="content">
    @can('hr_recruitment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.hr-recruitments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.hrRecruitment.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'HrRecruitment', 'route' => 'admin.hr-recruitments.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.hrRecruitment.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HrRecruitment">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.mobilenumber') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.file_path') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.called') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.interview_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hrRecruitment.fields.department') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\HrRecruitment::CALLED_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\HrRecruitment::STATUS_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($departments as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hrRecruitments as $key => $hrRecruitment)
                                    <tr data-entry-id="{{ $hrRecruitment->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $hrRecruitment->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hrRecruitment->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hrRecruitment->mobilenumber ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hrRecruitment->email ?? '' }}
                                        </td>
                                        <td>
                                            @if($hrRecruitment->file_path)
                                                <a href="{{ $hrRecruitment->file_path->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\HrRecruitment::CALLED_SELECT[$hrRecruitment->called] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\HrRecruitment::STATUS_SELECT[$hrRecruitment->status] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hrRecruitment->interview_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hrRecruitment->department->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('hr_recruitment_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.hr-recruitments.show', $hrRecruitment->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('hr_recruitment_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.hr-recruitments.edit', $hrRecruitment->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('hr_recruitment_delete')
                                                <form action="{{ route('admin.hr-recruitments.destroy', $hrRecruitment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hr_recruitment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hr-recruitments.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-HrRecruitment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection