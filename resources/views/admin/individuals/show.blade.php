@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.individual.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.individuals.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.id') }}
                        </th>
                        <td>
                            {{ $individual->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.name') }}
                        </th>
                        <td>
                            {{ $individual->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Individual::GENDER_SELECT[$individual->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.id_number') }}
                        </th>
                        <td>
                            {{ $individual->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.telephone') }}
                        </th>
                        <td>
                            {{ $individual->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.sector') }}
                        </th>
                        <td>
                            {{ $individual->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.cell') }}
                        </th>
                        <td>
                            {{ $individual->cell }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.individual.fields.village') }}
                        </th>
                        <td>
                            {{ $individual->village }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.individuals.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
