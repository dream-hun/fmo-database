@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.livestock.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.livestocks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.id') }}
                        </th>
                        <td>
                            {{ $livestock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.name') }}
                        </th>
                        <td>
                            {{ $livestock->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.id_number') }}
                        </th>
                        <td>
                            {{ $livestock->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.sector') }}
                        </th>
                        <td>
                            {{ $livestock->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.village') }}
                        </th>
                        <td>
                            {{ $livestock->village }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.distribution_date') }}
                        </th>
                        <td>
                            {{ $livestock->distribution_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.type') }}
                        </th>
                        <td>
                            {{ $livestock->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.number') }}
                        </th>
                        <td>
                            {{ $livestock->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.livestock.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Livestock::GENDER_SELECT[$livestock->gender] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.livestocks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
