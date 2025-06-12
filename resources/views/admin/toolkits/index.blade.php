@extends('layouts.admin')
@section('content')
    @can('toolkit_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.toolkits.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.toolkit.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Toolkit', 'route' => 'admin.toolkits.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.toolkit.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Toolkit">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.gender') }}
                        </th>

                        <th>
                            {{ trans('cruds.toolkit.fields.business_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.telephone') }}
                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.toolkit.fields.cell') }}
                        </th>

                        <th>
                            {{ trans('cruds.toolkit.fields.cohort') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($toolkits as $key => $toolkit)
                        <tr data-entry-id="{{ $toolkit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $toolkit->id ?? '' }}
                            </td>
                            <td>
                                {{ $toolkit->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Toolkit::GENDER_SELECT[$toolkit->gender] ?? '' }}
                            </td>

                            <td>
                                {{ $toolkit->business_name ?? '' }}
                            </td>
                            <td>
                                {{ $toolkit->telephone ?? '' }}
                            </td>
                            <td>
                                {{ $toolkit->sector ?? '' }}
                            </td>
                            <td>
                                {{ $toolkit->cell ?? '' }}
                            </td>

                            <td>
                                {{ $toolkit->cohort ?? '' }}
                            </td>
                            <td>
                                @can('toolkit_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.toolkits.show', $toolkit->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('toolkit_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.toolkits.edit', $toolkit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('toolkit_delete')
                                    <form action="{{ route('admin.toolkits.destroy', $toolkit->id) }}" method="POST"
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
            let table = $('.datatable-Toolkit:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
