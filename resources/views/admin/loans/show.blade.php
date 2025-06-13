@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.loan.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.loans.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.loan.fields.id') }}
                        </th>
                        <td>
                            {{ $loan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.loan.fields.individual') }}
                        </th>
                        <td>
                            {{ $loan->individual->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.loan.fields.business_name') }}
                        </th>
                        <td>
                            {{ $loan->business_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.loan.fields.amount') }}
                        </th>
                        <td>
                            {{ $loan->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.loan.fields.done_at') }}
                        </th>
                        <td>
                            {{ $loan->done_at }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.loans.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
