@extends('layouts.admin')
@section('content')
    @can('individual_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.individuals.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.individual.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Individual', 'route' => 'admin.individuals.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.individual.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Individual">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.individual.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.individual.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.individual.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.individual.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.individual.fields.telephone') }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($individuals as $key => $individual)
                        <tr data-entry-id="{{ $individual->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $individual->id ?? '' }}
                            </td>
                            <td>
                                {{ $individual->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Individual::GENDER_SELECT[$individual->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $individual->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $individual->telephone ?? '' }}
                            </td>

                            <td>
                                @can('individual_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.individuals.show', $individual->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('individual_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.individuals.edit', $individual->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('individual_delete')
                                    <form action="{{ route('admin.individuals.destroy', $individual->id) }}"
                                          method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
            let table = $('.datatable-Individual:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
