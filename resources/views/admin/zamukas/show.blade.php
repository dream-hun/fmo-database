@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.zamuka.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.zamukas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.id') }}
                        </th>
                        <td>
                            {{ $zamuka->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.head_of_household_name') }}
                        </th>
                        <td>
                            {{ $zamuka->head_of_household_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.household_id_number') }}
                        </th>
                        <td>
                            {{ $zamuka->household_id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.spouse_name') }}
                        </th>
                        <td>
                            {{ $zamuka->spouse_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.spouse_id_number') }}
                        </th>
                        <td>
                            {{ $zamuka->spouse_id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.sector') }}
                        </th>
                        <td>
                            {{ $zamuka->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.cell') }}
                        </th>
                        <td>
                            {{ $zamuka->cell }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.village') }}
                        </th>
                        <td>
                            {{ $zamuka->village }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.house_hold_phone') }}
                        </th>
                        <td>
                            {{ $zamuka->house_hold_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.family_size') }}
                        </th>
                        <td>
                            {{ $zamuka->family_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zamuka.fields.entrance_year') }}
                        </th>
                        <td>
                            {{ $zamuka->entrance_year }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.zamukas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
