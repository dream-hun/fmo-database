@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.malnutrition.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.malnutritions.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.malnutrition.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id">
                        @foreach($projects as $id => $entry)
                            <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.project_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="surname">{{ trans('cruds.malnutrition.fields.surname') }}</label>
                    <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', '') }}" required>
                    @if($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.surname_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.malnutrition.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="age">{{ trans('cruds.malnutrition.fields.age') }}</label>
                    <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', '') }}">
                    @if($errors->has('age'))
                        <span class="text-danger">{{ $errors->first('age') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.age_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="health_center">{{ trans('cruds.malnutrition.fields.health_center') }}</label>
                    <input class="form-control {{ $errors->has('health_center') ? 'is-invalid' : '' }}" type="text" name="health_center" id="health_center" value="{{ old('health_center', '') }}">
                    @if($errors->has('health_center'))
                        <span class="text-danger">{{ $errors->first('health_center') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.health_center_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.malnutrition.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.malnutrition.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', '') }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.malnutrition.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="father_name">{{ trans('cruds.malnutrition.fields.father_name') }}</label>
                    <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', '') }}">
                    @if($errors->has('father_name'))
                        <span class="text-danger">{{ $errors->first('father_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.father_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mother_name">{{ trans('cruds.malnutrition.fields.mother_name') }}</label>
                    <input class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', '') }}">
                    @if($errors->has('mother_name'))
                        <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.mother_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="home_phone">{{ trans('cruds.malnutrition.fields.home_phone') }}</label>
                    <input class="form-control {{ $errors->has('home_phone') ? 'is-invalid' : '' }}" type="text" name="home_phone" id="home_phone" value="{{ old('home_phone', '') }}">
                    @if($errors->has('home_phone'))
                        <span class="text-danger">{{ $errors->first('home_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.home_phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="package_reception_date">{{ trans('cruds.malnutrition.fields.package_reception_date') }}</label>
                    <input class="form-control date {{ $errors->has('package_reception_date') ? 'is-invalid' : '' }}" type="text" name="package_reception_date" id="package_reception_date" value="{{ old('package_reception_date') }}">
                    @if($errors->has('package_reception_date'))
                        <span class="text-danger">{{ $errors->first('package_reception_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.package_reception_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="entry_muac">{{ trans('cruds.malnutrition.fields.entry_muac') }}</label>
                    <input class="form-control {{ $errors->has('entry_muac') ? 'is-invalid' : '' }}" type="number" name="entry_muac" id="entry_muac" value="{{ old('entry_muac', '') }}" step="1">
                    @if($errors->has('entry_muac'))
                        <span class="text-danger">{{ $errors->first('entry_muac') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.entry_muac_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="currently_muac">{{ trans('cruds.malnutrition.fields.currently_muac') }}</label>
                    <input class="form-control {{ $errors->has('currently_muac') ? 'is-invalid' : '' }}" type="number" name="currently_muac" id="currently_muac" value="{{ old('currently_muac', '') }}" step="1">
                    @if($errors->has('currently_muac'))
                        <span class="text-danger">{{ $errors->first('currently_muac') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.currently_muac_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.malnutrition.fields.current_malnutrition_code') }}</label>
                    <select class="form-control {{ $errors->has('current_malnutrition_code') ? 'is-invalid' : '' }}" name="current_malnutrition_code" id="current_malnutrition_code">
                        <option value disabled {{ old('current_malnutrition_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Malnutrition::CURRENT_MALNUTRITION_CODE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('current_malnutrition_code', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('current_malnutrition_code'))
                        <span class="text-danger">{{ $errors->first('current_malnutrition_code') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.current_malnutrition_code_helper') }}</span>
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
