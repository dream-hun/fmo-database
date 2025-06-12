@extends('layouts.admin')
@section('content')
    @can('member_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.members.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.member.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Member', 'route' => 'admin.members.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.member.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Member">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.member.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.group') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.telephone') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.cell') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.village') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $key => $member)
                        <tr data-entry-id="{{ $member->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $member->id ?? '' }}
                            </td>
                            <td>
                                {{ $member->group->name ?? '' }}
                            </td>
                            <td>
                                {{ $member->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Member::GENDER_SELECT[$member->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $member->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $member->telephone ?? '' }}
                            </td>
                            <td>
                                {{ $member->sector ?? '' }}
                            </td>
                            <td>
                                {{ $member->cell ?? '' }}
                            </td>
                            <td>
                                {{ $member->village ?? '' }}
                            </td>
                            <td>
                                @can('member_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.members.show', $member->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('member_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.members.edit', $member->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('member_delete')
                                    <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
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
            let table = $('.datatable-Member:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
