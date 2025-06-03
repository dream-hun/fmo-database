@extends('layouts.admin')
@section('content')
    @can('food_and_house_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.food-and-houses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.foodAndHouse.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'FoodAndHouse', 'route' => 'admin.food-and-houses.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.foodAndHouse.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-FoodAndHouse">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.id_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.cell') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.village') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.support') }}
                        </th>
                        <th>
                            {{ trans('cruds.foodAndHouse.fields.date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($foodAndHouses as $key => $foodAndHouse)
                        <tr data-entry-id="{{ $foodAndHouse->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $foodAndHouse->id ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->name ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->id_number ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->cell ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->village ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->phone_number ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->support ?? '' }}
                            </td>
                            <td>
                                {{ $foodAndHouse->date ?? '' }}
                            </td>
                            <td>
                                @can('food_and_house_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.food-and-houses.show', $foodAndHouse->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('food_and_house_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.food-and-houses.edit', $foodAndHouse->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('food_and_house_delete')
                                    <form action="{{ route('admin.food-and-houses.destroy', $foodAndHouse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            let table = $('.datatable-FoodAndHouse:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
