@extends('layouts.admin')
@section('content')
    @can('goat_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.goats.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.goat.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.goat.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Goat">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.names') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.id_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.sector') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.distribution_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.number_of_goats') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.gender') }}
                            </th>
                            <th>
                                {{ trans('cruds.goat.fields.pass_over') }}
                            </th>

                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($goats as $key => $goat)
                            <tr data-entry-id="{{ $goat->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $goat->id ?? '' }}
                                </td>
                                <td>
                                    {{ $goat->names ?? '' }}
                                </td>
                                <td>
                                    {{ $goat->id_number ?? '' }}
                                </td>
                                <td>
                                    {{ $goat->sector ?? '' }}
                                </td>
                                <td>
                                    {{ $goat->distribution_date ?? '' }}
                                </td>
                                <td>
                                    {{ $goat->number_of_goats ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Goat::GENDER_SELECT[$goat->gender] ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $goat->pass_over ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $goat->pass_over ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('goat_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.goats.edit', $goat->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('goat_delete')
                                        <form action="{{ route('admin.goats.destroy', $goat->id) }}" method="POST"
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
            let table = $('.datatable-Goat:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
