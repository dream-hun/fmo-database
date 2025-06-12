@extends('layouts.admin')
@section('content')
    @can('malnutrition_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.malnutritions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.malnutrition.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Malnutrition', 'route' => 'admin.malnutritions.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.malnutrition.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Malnutrition">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.malnutrition.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.malnutrition.fields.name') }}
                        </th>

                        <th>
                            {{ trans('cruds.malnutrition.fields.health_center') }}
                        </th>
                        <th>
                            {{ trans('cruds.malnutrition.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.malnutrition.fields.cell') }}
                        </th>
                        <th>
                            {{ trans('cruds.malnutrition.fields.village') }}
                        </th>

                        <th>
                            {{ trans('cruds.malnutrition.fields.package_reception_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($malnutritions as $key => $malnutrition)
                        <tr data-entry-id="{{ $malnutrition->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $malnutrition->id ?? '' }}
                            </td>
                            <td>
                                {{ $malnutrition->name ?? '' }}
                            </td>

                            <td>
                                {{ $malnutrition->health_center ?? '' }}
                            </td>
                            <td>
                                {{ $malnutrition->sector ?? '' }}
                            </td>
                            <td>
                                {{ $malnutrition->cell ?? '' }}
                            </td>
                            <td>
                                {{ $malnutrition->village ?? '' }}
                            </td>


                            <td>
                                {{ $malnutrition->package_reception_date ?? '' }}
                            </td>
                            <td>

                                @can('malnutrition_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.malnutritions.edit', $malnutrition->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('malnutrition_delete')
                                    <form action="{{ route('admin.malnutritions.destroy', $malnutrition->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Malnutrition:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
