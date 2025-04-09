@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tank.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tanks.update", [$tank->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="names">{{ trans('cruds.tank.fields.names') }}</label>
                <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names" id="names" value="{{ old('names', $tank->names) }}" required>
                @if($errors->has('names'))
                    <span class="text-danger">{{ $errors->first('names') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.names_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_number">{{ trans('cruds.tank.fields.id_number') }}</label>
                <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number" id="id_number" value="{{ old('id_number', $tank->id_number) }}" step="1">
                @if($errors->has('id_number'))
                    <span class="text-danger">{{ $errors->first('id_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.id_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sector">{{ trans('cruds.tank.fields.sector') }}</label>
                <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $tank->sector) }}">
                @if($errors->has('sector'))
                    <span class="text-danger">{{ $errors->first('sector') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.sector_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cell">{{ trans('cruds.tank.fields.cell') }}</label>
                <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $tank->cell) }}">
                @if($errors->has('cell'))
                    <span class="text-danger">{{ $errors->first('cell') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.cell_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="village">{{ trans('cruds.tank.fields.village') }}</label>
                <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $tank->village) }}">
                @if($errors->has('village'))
                    <span class="text-danger">{{ $errors->first('village') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.village_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_of_tank">{{ trans('cruds.tank.fields.no_of_tank') }}</label>
                <input class="form-control {{ $errors->has('no_of_tank') ? 'is-invalid' : '' }}" type="text" name="no_of_tank" id="no_of_tank" value="{{ old('no_of_tank', $tank->no_of_tank) }}">
                @if($errors->has('no_of_tank'))
                    <span class="text-danger">{{ $errors->first('no_of_tank') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.no_of_tank_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="distribution_date">{{ trans('cruds.tank.fields.distribution_date') }}</label>
                <input class="form-control date {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}" type="text" name="distribution_date" id="distribution_date" value="{{ old('distribution_date', $tank->distribution_date) }}">
                @if($errors->has('distribution_date'))
                    <span class="text-danger">{{ $errors->first('distribution_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.distribution_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.tank.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $tank->status) }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tank.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
