@extends('layouts.admin')
@section('content')
    @can('musa_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.musas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.musa.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Musa', 'route' => 'admin.musas.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.musa.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Musa">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.family_members') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.support_given') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.support_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.cell') }}
                        </th>
                        <th>
                            {{ trans('cruds.musa.fields.village') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($musas as $key => $musa)
                        <tr data-entry-id="{{ $musa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $musa->id ?? '' }}
                            </td>
                            <td>
                                {{ $musa->name ?? '' }}
                            </td>
                            <td>
                                {{ $musa->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $musa->family_members ?? '' }}
                            </td>
                            <td>
                                {{ $musa->support_given ?? '' }}
                            </td>
                            <td>
                                {{ $musa->support_date ?? '' }}
                            </td>
                            <td>
                                {{ $musa->sector ?? '' }}
                            </td>
                            <td>
                                {{ $musa->cell ?? '' }}
                            </td>
                            <td>
                                {{ $musa->village ?? '' }}
                            </td>
                            <td>

                                @can('musa_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.musas.edit', $musa->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('musa_delete')
                                    <form action="{{ route('admin.musas.destroy', $musa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Musa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
