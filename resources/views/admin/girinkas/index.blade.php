@extends('layouts.admin')
@section('content')
    @can('girinka_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.girinkas.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.girinka.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Girinka', 'route' => 'admin.girinkas.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.girinka.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Girinka">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.distribution_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.girinka.fields.telephone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($girinkas as $key => $girinka)
                        <tr data-entry-id="{{ $girinka->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $girinka->id ?? '' }}
                            </td>
                            <td>
                                {{ $girinka->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Girinka::GENDER_SELECT[$girinka->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $girinka->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $girinka->sector ?? '' }}
                            </td>
                            <td>
                                {{ $girinka->distribution_date ?? '' }}
                            </td>
                            <td>
                                {{ $girinka->telephone ?? '' }}
                            </td>
                            <td>

                                @can('girinka_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.girinkas.edit', $girinka->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('girinka_delete')
                                    <form action="{{ route('admin.girinkas.destroy', $girinka->id) }}" method="POST"
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
            let table = $('.datatable-Girinka:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
