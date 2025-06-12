@extends('layouts.admin')
@section('content')
    @can('zamuka_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.zamukas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.zamuka.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Zamuka', 'route' => 'admin.zamukas.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.zamuka.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Zamuka">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.zamuka.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.zamuka.fields.head_of_household_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.zamuka.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.zamuka.fields.family_size') }}
                        </th>
                        <th>
                            {{ trans('cruds.zamuka.fields.entrance_year') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zamukas as $key => $zamuka)
                        <tr data-entry-id="{{ $zamuka->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $zamuka->id ?? '' }}
                            </td>
                            <td>
                                {{ $zamuka->head_of_household_name ?? '' }}
                            </td>
                            <td>
                                {{ $zamuka->sector ?? '' }}
                            </td>
                            <td>
                                {{ $zamuka->family_size ?? '' }}
                            </td>
                            <td>
                                {{ $zamuka->entrance_year ?? '' }}
                            </td>
                            <td>
                                @can('zamuka_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.zamukas.show', $zamuka->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('zamuka_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.zamukas.edit', $zamuka->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('zamuka_delete')
                                    <form action="{{ route('admin.zamukas.destroy', $zamuka->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Zamuka:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
