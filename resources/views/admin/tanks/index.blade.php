@extends('layouts.admin')
@section('content')
    @can('tank_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.tanks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.tank.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Tank', 'route' => 'admin.tanks.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.tank.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Tank">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.tank.fields.distribution_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tanks as $key => $tank)
                        <tr data-entry-id="{{ $tank->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tank->id ?? '' }}
                            </td>
                            <td>
                                {{ $tank->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Tank::GENDER_SELECT[$tank->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $tank->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $tank->sector ?? '' }}
                            </td>
                            <td>
                                {{ $tank->distribution_date ?? '' }}
                            </td>
                            <td>

                                @can('tank_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tanks.edit', $tank->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tank_delete')
                                    <form action="{{ route('admin.tanks.destroy', $tank->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="{{ trans('global.delete') }}">
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
                order: [[1, 'desc']],
                pageLength: 100,
            });
            let table = $('.datatable-Tank:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
