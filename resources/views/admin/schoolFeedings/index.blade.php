@extends('layouts.admin')
@section('content')
    @can('school_feeding_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.school-feedings.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.schoolFeeding.title_singular') }}
                </a>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'SchoolFeeding', 'route' => 'admin.school-feedings.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.schoolFeeding.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-SchoolFeeding">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.school_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.academic_year') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.fathers_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.mothers_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolFeeding.fields.home_phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schoolFeedings as $key => $schoolFeeding)
                        <tr data-entry-id="{{ $schoolFeeding->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $schoolFeeding->id ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\SchoolFeeding::GENDER_SELECT[$schoolFeeding->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->school_name ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->academic_year ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->fathers_name ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->mothers_name ?? '' }}
                            </td>
                            <td>
                                {{ $schoolFeeding->home_phone ?? '' }}
                            </td>
                            <td>


                                @can('school_feeding_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.school-feedings.edit', $schoolFeeding->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('school_feeding_delete')
                                    <form action="{{ route('admin.school-feedings.destroy', $schoolFeeding->id) }}"
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
            let table = $('.datatable-SchoolFeeding:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
