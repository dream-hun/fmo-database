@extends('layouts.admin')
@section('content')
    @can('urgent_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.urgents.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.urgent.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Urgent', 'route' => 'admin.urgents.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.urgent.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Urgent">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.cell') }}
                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.support') }}
                        </th>
                        <th>
                            {{ trans('cruds.urgent.fields.support_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($urgents as $key => $urgent)
                        <tr data-entry-id="{{ $urgent->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $urgent->id ?? '' }}
                            </td>
                            <td>
                                {{ $urgent->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Urgent::GENDER_SELECT[$urgent->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $urgent->cell ?? '' }}
                            </td>
                            <td>
                                {{ $urgent->support ?? '' }}
                            </td>
                            <td>
                                {{ $urgent->support_date ?? '' }}
                            </td>
                            <td>

                                @can('urgent_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.urgents.edit', $urgent->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('urgent_delete')
                                    <form action="{{ route('admin.urgents.destroy', $urgent->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Urgent:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
