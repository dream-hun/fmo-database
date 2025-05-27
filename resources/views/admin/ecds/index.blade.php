@extends('layouts.admin')
@section('content')
    @can('ecd_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.ecds.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.ecd.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.ecd.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-ecd">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ecd.fields.id') }}
                        </th>
                        <th>
                            Name
                        </th>

                        <th>
                            {{ trans('cruds.ecd.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.ecd.fields.grade') }}
                        </th>
                        <th>
                            {{ trans('cruds.ecd.fields.academic_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.ecd.fields.home_phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ecds as $key => $ecd)
                        <tr data-entry-id="{{ $ecd->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ecd->id ?? '' }}
                            </td>
                            <td>
                                {{ $ecd->name ?? '' }}
                            </td>

                            <td>
                                {{ $ecd->gender ?? '' }}
                            </td>
                            <td>
                                {{ $ecd->grade ?? '' }}
                            </td>
                            <td>
                                {{ $ecd->academic_year ?? '' }}
                            </td>
                            <td>
                                {{ $ecd->home_phone ?? '' }}
                            </td>
                            <td>

                                @can('ecd_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ecds.edit', $ecd->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('ecd_delete')
                                    <form action="{{ route('admin.ecds.destroy', $ecd->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-ecd:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
