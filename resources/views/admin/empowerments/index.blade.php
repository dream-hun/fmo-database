@extends('layouts.admin')
@section('content')
    @can('empowerment_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.empowerments.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.empowerment.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Empowerment', 'route' => 'admin.empowerments.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.empowerment.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Empowerment">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.support') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.support_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.empowerment.fields.supported_children') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($empowerments as $key => $empowerment)
                        <tr data-entry-id="{{ $empowerment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $empowerment->id ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->name ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->sector ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->support ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->support_date ?? '' }}
                            </td>
                            <td>
                                {{ $empowerment->supported_children ?? '' }}
                            </td>
                            <td>
                                @can('empowerment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.empowerments.show', $empowerment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('empowerment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.empowerments.edit', $empowerment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('empowerment_delete')
                                    <form action="{{ route('admin.empowerments.destroy', $empowerment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Empowerment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
