@extends('layouts.admin')
@section('content')
    @can('fruit_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.fruits.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.fruit.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Fruit', 'route' => 'admin.fruits.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.fruit.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Fruit">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.sector') }}
                        </th>
                        <th>
                            {{ trans('cruds.fruit.fields.distribution_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fruits as $key => $fruit)
                        <tr data-entry-id="{{ $fruit->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $fruit->id ?? '' }}
                            </td>
                            <td>
                                {{ $fruit->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Fruit::GENDER_SELECT[$fruit->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $fruit->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $fruit->sector ?? '' }}
                            </td>
                            <td>
                                {{ $fruit->distribution_date ?? '' }}
                            </td>
                            <td>

                                @can('fruit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fruits.edit', $fruit->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fruit_delete')
                                    <form action="{{ route('admin.fruits.destroy', $fruit->id) }}" method="POST"
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
            let table = $('.datatable-Fruit:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
