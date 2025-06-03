@extends('layouts.admin')
@section('content')
@can('training_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.trainings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.training.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Training', 'route' => 'admin.trainings.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.training.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Training">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.training.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.national') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.district') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.telephone') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.training_given') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.position') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.institution') }}
                        </th>
                        <th>
                            {{ trans('cruds.training.fields.training_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainings as $key => $training)
                        <tr data-entry-id="{{ $training->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $training->id ?? '' }}
                            </td>
                            <td>
                                {{ $training->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Training::GENDER_SELECT[$training->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $training->national ?? '' }}
                            </td>
                            <td>
                                {{ $training->district ?? '' }}
                            </td>
                            <td>
                                {{ $training->sector ?? '' }}
                            </td>
                            <td>
                                {{ $training->telephone ?? '' }}
                            </td>
                            <td>
                                {{ $training->training_given ?? '' }}
                            </td>
                            <td>
                                {{ $training->position ?? '' }}
                            </td>
                            <td>
                                {{ $training->institution ?? '' }}
                            </td>
                            <td>
                                {{ $training->training_date ?? '' }}
                            </td>
                            <td>

                                @can('training_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.trainings.edit', $training->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('training_delete')
                                    <form action="{{ route('admin.trainings.destroy', $training->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Training:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection