@extends('layouts.admin')
@section('content')
    @can('livestock_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.livestocks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.livestock.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Livestock', 'route' => 'admin.livestocks.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.livestock.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Livestock">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.village') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.distribution_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.number') }}
                        </th>
                        <th>
                            {{ trans('cruds.livestock.fields.gender') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($livestocks as $key => $livestock)
                        <tr data-entry-id="{{ $livestock->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $livestock->id ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->name ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->sector ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->village ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->distribution_date ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->type ?? '' }}
                            </td>
                            <td>
                                {{ $livestock->number ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Livestock::GENDER_SELECT[$livestock->gender] ?? '' }}
                            </td>
                            <td>
                                @can('livestock_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.livestocks.show', $livestock->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('livestock_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.livestocks.edit', $livestock->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('livestock_delete')
                                    <form action="{{ route('admin.livestocks.destroy', $livestock->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Livestock:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
