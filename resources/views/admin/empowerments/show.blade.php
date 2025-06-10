@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.empowerment.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.empowerments.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.id') }}
                        </th>
                        <td>
                            {{ $empowerment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.name') }}
                        </th>
                        <td>
                            {{ $empowerment->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.sector') }}
                        </th>
                        <td>
                            {{ $empowerment->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.support') }}
                        </th>
                        <td>
                            {{ $empowerment->support }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.support_date') }}
                        </th>
                        <td>
                            {{ $empowerment->support_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.empowerment.fields.supported_children') }}
                        </th>
                        <td>
                            {{ $empowerment->supported_children }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.empowerments.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
