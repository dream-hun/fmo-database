@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.scholarship.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.scholarships.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.scholarship.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.scholarship.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender" required>
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Scholarship::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="id_number">{{ trans('cruds.scholarship.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text"
                           name="id_number" id="id_number" value="{{ old('id_number', '') }}" required>
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="district">{{ trans('cruds.scholarship.fields.district') }}</label>
                    <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text"
                           name="district" id="district" value="{{ old('district', '') }}" required>
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.scholarship.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', '') }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cell">{{ trans('cruds.scholarship.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', '') }}" required>
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.scholarship.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="telephone">{{ trans('cruds.scholarship.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text"
                           name="telephone" id="telephone" value="{{ old('telephone', '') }}" required>
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.scholarship.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email"
                           id="email" value="{{ old('email', '') }}" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="school">{{ trans('cruds.scholarship.fields.school') }}</label>
                    <input class="form-control {{ $errors->has('school') ? 'is-invalid' : '' }}" type="text"
                           name="school" id="school" value="{{ old('school', '') }}" required>
                    @if($errors->has('school'))
                        <span class="text-danger">{{ $errors->first('school') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.school_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="study_option">{{ trans('cruds.scholarship.fields.study_option') }}</label>
                    <input class="form-control {{ $errors->has('study_option') ? 'is-invalid' : '' }}" type="text"
                           name="study_option" id="study_option" value="{{ old('study_option', '') }}" required>
                    @if($errors->has('study_option'))
                        <span class="text-danger">{{ $errors->first('study_option') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.study_option_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="entrance_year">{{ trans('cruds.scholarship.fields.entrance_year') }}</label>
                    <input class="form-control {{ $errors->has('entrance_year') ? 'is-invalid' : '' }}" type="text"
                           name="entrance_year" id="entrance_year" value="{{ old('entrance_year', '') }}" required>
                    @if($errors->has('entrance_year'))
                        <span class="text-danger">{{ $errors->first('entrance_year') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.entrance_year_helper') }}</span>
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
