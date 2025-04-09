@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.vsla.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.vslas.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.vsla.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id">
                        @foreach($projects as $id => $entry)
                            <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.project_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="vlsa">{{ trans('cruds.vsla.fields.vlsa') }}</label>
                    <input class="form-control {{ $errors->has('vlsa') ? 'is-invalid' : '' }}" type="text" name="vlsa" id="vlsa" value="{{ old('vlsa', '') }}" required>
                    @if($errors->has('vlsa'))
                        <span class="text-danger">{{ $errors->first('vlsa') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.vlsa_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="surname">{{ trans('cruds.vsla.fields.surname') }}</label>
                    <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', '') }}" required>
                    @if($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.surname_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.vsla.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.vsla.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Vsla::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.vsla.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number" id="id_number" value="{{ old('id_number', '') }}" step="1">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.vsla.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.vsla.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.vsla.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', '') }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.vsla.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.vsla.fields.village_helper') }}</span>
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
