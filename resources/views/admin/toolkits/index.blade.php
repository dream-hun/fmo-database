@extends('layouts.admin')
@section('content')
    @can('toolkit_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="row col-lg-12">
                <div class="col-md-4">
                    <a class="btn btn-success" href="{{ route('admin.toolkits.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.toolkit.title_singular') }}
                    </a>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('admin.toolkits.import') }}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="importFile">Choose File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input {{ $errors->has('file') ? 'is-invalid' : '' }}"
                                        name="file" id="importFile"
                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    <label class="custom-file-label" for="importFile">Select file</label>
                                </div>
                            </div>
                            @if ($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-file-earmark-arrow-up"></i> {{ trans('global.import_data') }}
                            </button>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="alert alert-info mb-0">
                                <strong>Import Instructions:</strong>
                                <ul class="mb-0 pl-3">
                                    <li>File must be CSV or Excel (.xlsx) format</li>
                                    <li>First row must contain column headers</li>
                                    <li>Required columns: <strong>Name</strong> and <strong>Project ID</strong></li>
                                    <li>Optional columns: Gender, Identification Number, Phone Number, TVET Attended, Option, Level, Training Intake, Reception Date, Toolkit Received, Toolkit Cost, Subsidized Percent, Sector, Total</li>
                                    <li>Maximum file size: <strong>10MB</strong></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.toolkit.title_singular') }} {{ trans('global.list') }}
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
                <table class="table table-bordered table-striped table-hover datatable datatable-Toolkit">
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
                                {{ trans('cruds.toolkit.fields.identification_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.toolkit.fields.phone_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.toolkit.fields.tvet_attended') }}
                            </th>
                            <th>
                                {{ trans('cruds.toolkit.fields.option') }}
                            </th>
                            <th>
                                {{ trans('cruds.toolkit.fields.level') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($toolkits as $key => $toolkit)
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
                                    {{ $toolkit->gender ?? '' }}
                                </td>
                                <td>
                                    {{ $toolkit->id_number ?? '' }}
                                </td>
                                <td>
                                    {{ $toolkit->phone_number ?? '' }}
                                </td>
                                <td>
                                    {{ $toolkit->tvet_attended ?? '' }}
                                </td>
                                <td>
                                    {{ $toolkit->option ?? '' }}
                                </td>
                                <td>
                                    {{ $toolkit->level ?? '' }}
                                </td>
                                <td>
                                    @can('toolkit_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.toolkits.edit', $toolkit->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('toolkit_delete')
                                        <form action="{{ route('admin.toolkits.destroy', $toolkit->id) }}"
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
            let table = $('.datatable-Toolkit:not(.ajaxTable)').DataTable({
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
