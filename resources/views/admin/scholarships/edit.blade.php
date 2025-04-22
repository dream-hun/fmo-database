@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.scholarship.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.scholarships.update", [$scholarship->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.scholarship.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id">
                        @foreach($projects as $id => $entry)
                            <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $scholarship->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.project_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="names">{{ trans('cruds.scholarship.fields.names') }}</label>
                    <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names" id="names" value="{{ old('names', $scholarship->names) }}" required>
                    @if($errors->has('names'))
                        <span class="text-danger">{{ $errors->first('names') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.names_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.scholarship.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Scholarship::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $scholarship->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.scholarship.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $scholarship->id_number) }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="district">{{ trans('cruds.scholarship.fields.district') }}</label>
                    <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text" name="district" id="district" value="{{ old('district', $scholarship->district) }}">
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.scholarship.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $scholarship->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.scholarship.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $scholarship->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.scholarship.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $scholarship->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.scholarship.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $scholarship->telephone) }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('cruds.scholarship.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $scholarship->email) }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="school">{{ trans('cruds.scholarship.fields.school') }}</label>
                    <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text" name="school" id="school" value="{{ old('school', $scholarship->school) }}">
                    @if($errors->has('school'))
                        <span class="text-danger">{{ $errors->first('school') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.school_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="study_option">{{ trans('cruds.scholarship.fields.study_option') }}</label>
                    <input class="form-control {{ $errors->has('study_option') ? 'is-invalid' : '' }}" type="text" name="study_option" id="study_option" value="{{ old('study_option', $scholarship->study_option) }}">
                    @if($errors->has('study_option'))
                        <span class="text-danger">{{ $errors->first('study_option') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.study_option_helper') }}</span>
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
