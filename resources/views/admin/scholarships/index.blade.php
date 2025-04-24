@extends('layouts.admin')
@section('content')
    @can('scholarship_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="row col-lg-12">

                <div class="col-md-6">
                    <a class="btn btn-success" href="{{ route('admin.scholarships.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.scholarship.title_singular') }}
                    </a>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('admin.scholarships.import') }}" method="post" enctype="multipart/form-data" x-data="{ fileName: '', loading: false }">
                        @csrf
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file"
                                    class="custom-file-input {{ $errors->has('file') ? 'is-invalid' : '' }}"
                                    name="file"
                                    accept=".csv,.xlsx"
                                    x-ref="file"
                                    @change="fileName = $refs.file.files[0].name"
                                    id="importFile"
                                    required>
                                <label class="custom-file-label" for="importFile" x-text="fileName || 'Choose file'">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn btn-primary"
                                    x-bind:disabled="loading"
                                    @click="loading = true">
                                    <span x-show="!loading">Import Data</span>
                                    <span x-show="loading">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        Processing...
                                    </span>
                                </button>
                            </div>
                        </div>
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>

            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.scholarship.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
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
                                {{ trans('cruds.scholarship.fields.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.id_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.telephone') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.school') }}
                            </th>
                            <th>
                                {{ trans('cruds.scholarship.fields.study_option') }}
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
                                    {{ $scholarship->names ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Scholarship::GENDER_SELECT[$scholarship->gender] ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->id_number ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->telephone ?? '' }}
                                </td>
                               
                                <td>
                                    {{ $scholarship->school ?? '' }}
                                </td>
                                <td>
                                    {{ $scholarship->study_option ?? '' }}
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
    </script>
@endsection
