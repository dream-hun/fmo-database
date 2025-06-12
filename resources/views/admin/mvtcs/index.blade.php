@extends('layouts.admin')
@section('content')
    @can('mvtc_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mvtcs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.mvtc.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Mvtc', 'route' => 'admin.mvtcs.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.mvtc.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Mvtc">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.student') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.trade') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.intake') }}
                        </th>
                        <th>
                            {{ trans('cruds.mvtc.fields.graduation_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mvtcs as $key => $mvtc)
                        <tr data-entry-id="{{ $mvtc->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $mvtc->id ?? '' }}
                            </td>
                            <td>
                                {{ $mvtc->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Mvtc::GENDER_SELECT[$mvtc->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $mvtc->student ?? '' }}
                            </td>
                            <td>
                                {{ $mvtc->trade ?? '' }}
                            </td>
                            <td>
                                {{ $mvtc->intake ?? '' }}
                            </td>
                            <td>
                                {{ $mvtc->graduation_date ?? '' }}
                            </td>
                            <td>

                                @can('mvtc_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.mvtcs.edit', $mvtc->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('mvtc_delete')
                                    <form action="{{ route('admin.mvtcs.destroy', $mvtc->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Mvtc:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
