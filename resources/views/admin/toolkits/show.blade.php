@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.toolkit.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.toolkits.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.id') }}
                        </th>
                        <td>
                            {{ $toolkit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.name') }}
                        </th>
                        <td>
                            {{ $toolkit->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Toolkit::GENDER_SELECT[$toolkit->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.id_number') }}
                        </th>
                        <td>
                            {{ $toolkit->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.business_name') }}
                        </th>
                        <td>
                            {{ $toolkit->business_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.telephone') }}
                        </th>
                        <td>
                            {{ $toolkit->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.sector') }}
                        </th>
                        <td>
                            {{ $toolkit->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.cell') }}
                        </th>
                        <td>
                            {{ $toolkit->cell }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.village') }}
                        </th>
                        <td>
                            {{ $toolkit->village }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.toolkit.fields.cohort') }}
                        </th>
                        <td>
                            {{ $toolkit->cohort }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.toolkits.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
