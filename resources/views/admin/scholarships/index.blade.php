@extends('layouts.admin')
@section('content')
    @can('scholarship_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="row col-lg-12">
                <div class="col-md-4">
                    <a class="btn btn-success" href="{{ route('admin.scholarships.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.scholarship.title_singular') }}
                    </a>
                </div>

            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.scholarship.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">
                    {{ session('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Scholarship">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.names') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.school') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.study_option') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.entrance_year') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scholarships as $key => $scholarship)
                            <tr data-entry-id="{{ $scholarship->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $scholarship->id ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->name ?? '' }}
                                </td>

                                <td>
                                    {{ $scholarship->school ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->study_option ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->entrance_year ?? '' }}
                                </td>
                                <td>

                                    @can('scholarship_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.scholarships.edit', $scholarship->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('scholarship_delete')
                                        <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}"
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Scholarship:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
