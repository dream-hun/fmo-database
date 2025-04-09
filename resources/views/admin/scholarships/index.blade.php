@extends('layouts.admin')
@section('content')
    @can('scholarship_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.scholarships.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.scholarship.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.scholarship.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Scholarship">
                    <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            {{ trans('cruds.scholarship.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.scholarship.fields.surname') }}
                        </th>
                        <th>
                            {{ trans('cruds.scholarship.fields.first_name') }}
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
                            {{ trans('cruds.scholarship.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.scholarship.fields.school_to_attend') }}
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
                    @foreach($scholarships as $key => $scholarship)
                        <tr data-entry-id="{{ $scholarship->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $scholarship->id ?? '' }}
                            </td>
                            <td>
                                {{ $scholarship->surname ?? '' }}
                            </td>
                            <td>
                                {{ $scholarship->first_name ?? '' }}
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
                                {{ $scholarship->email ?? '' }}
                            </td>
                            <td>
                                {{ $scholarship->school_to_attend ?? '' }}
                            </td>
                            <td>
                                {{ $scholarship->study_option ?? '' }}
                            </td>
                            <td>
                                @can('scholarship_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.scholarships.show', $scholarship->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('scholarship_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.scholarships.edit', $scholarship->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('scholarship_delete')
                                    <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-Scholarship:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
