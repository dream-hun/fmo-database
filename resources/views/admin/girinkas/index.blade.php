@extends('layouts.admin')
@section('content')
    @can('girinka_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="row col-lg-12">
                <div class="col-md-4">
                    <a class="btn btn-success" href="{{ route('admin.girinkas.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.girinka.title_singular') }}
                    </a>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('admin.girinkas.import') }}" method="POST" enctype="multipart/form-data"
                        class="row">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="importFile">Choose File <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file"
                                        id="importFile"
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
                                    <li>Required columns: <strong>Names</strong> and <strong>Year of Entrance</strong></li>
                                    <li>Gender values should be: <em>F</em> for female or <em>M</em> for male</li>
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
            {{ trans('cruds.girinka.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Girinka">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.names') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.id_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.sector') }}
                            </th>

                            <th>
                                {{ trans('cruds.girinka.fields.distribution_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.m_status') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.pass_over') }}
                            </th>
                            <th>
                                {{ trans('cruds.girinka.fields.telephone') }}
                            </th>

                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($girinkas as $key => $girinka)
                            <tr data-entry-id="{{ $girinka->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $girinka->id ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->names ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Girinka::GENDER_SELECT[$girinka->gender] ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->id_number ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->sector ?? '' }}
                                </td>

                                <td>
                                    {{ $girinka->distribution_date ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->m_status ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->pass_over ?? '' }}
                                </td>
                                <td>
                                    {{ $girinka->telephone ?? '' }}
                                </td>
                                <td>


                                    @can('girinka_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.girinkas.edit', $girinka->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('girinka_delete')
                                        <form action="{{ route('admin.girinkas.destroy', $girinka->id) }}" method="POST"
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Girinka:not(.ajaxTable)').DataTable({
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
