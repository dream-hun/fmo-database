@extends('layouts.admin')
@section('content')
    @can('group_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.groups.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.group.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Group', 'route' => 'admin.groups.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.group.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Group">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.representer') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.representer_phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.mou_signed_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.group.fields.number_of_members') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $key => $group)
                        <tr data-entry-id="{{ $group->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $group->id ?? '' }}
                            </td>
                            <td>
                                {{ $group->code ?? '' }}
                            </td>
                            <td>
                                {{ $group->name ?? '' }}
                            </td>
                            <td>
                                {{ $group->representer ?? '' }}
                            </td>
                            <td>
                                {{ $group->representer_phone ?? '' }}
                            </td>
                            <td>
                                {{ $group->mou_signed_at ?? '' }}
                            </td>
                            <td>
                                {{ $group->number_of_members ?? '' }}
                            </td>
                            <td>
                                @can('group_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.groups.show', $group->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('group_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.groups.edit', $group->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('group_delete')
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST"
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
            let table = $('.datatable-Group:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
