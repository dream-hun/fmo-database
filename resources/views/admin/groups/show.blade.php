@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.group.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <td>
                            {{ $group->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.code') }}
                        </th>
                        <td>
                            {{ $group->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <td>
                            {{ $group->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.representer') }}
                        </th>
                        <td>
                            {{ $group->representer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.representer_phone') }}
                        </th>
                        <td>
                            {{ $group->representer_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.mou_signed_at') }}
                        </th>
                        <td>
                            {{ $group->mou_signed_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.number_of_members') }}
                        </th>
                        <td>
                            {{ $group->number_of_members }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
