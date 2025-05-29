@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.musa.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.musas.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.musa.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.musa.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', '') }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="family_members">{{ trans('cruds.musa.fields.family_members') }}</label>
                    <input class="form-control {{ $errors->has('family_members') ? 'is-invalid' : '' }}" type="number" name="family_members" id="family_members" value="{{ old('family_members', '') }}" step="1">
                    @if($errors->has('family_members'))
                        <span class="text-danger">{{ $errors->first('family_members') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.family_members_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="support_given">{{ trans('cruds.musa.fields.support_given') }}</label>
                    <input class="form-control {{ $errors->has('support_given') ? 'is-invalid' : '' }}" type="number" name="support_given" id="support_given" value="{{ old('support_given', '') }}" step="1">
                    @if($errors->has('support_given'))
                        <span class="text-danger">{{ $errors->first('support_given') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.support_given_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="support_date">{{ trans('cruds.musa.fields.support_date') }}</label>
                    <input class="form-control date {{ $errors->has('support_date') ? 'is-invalid' : '' }}" type="text" name="support_date" id="support_date" value="{{ old('support_date') }}">
                    @if($errors->has('support_date'))
                        <span class="text-danger">{{ $errors->first('support_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.support_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.musa.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.musa.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', '') }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.musa.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.musa.fields.village_helper') }}</span>
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
