@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.schoolFeeding.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.school-feedings.update", [$schoolFeeding->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.schoolFeeding.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $schoolFeeding->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="grade">{{ trans('cruds.schoolFeeding.fields.grade') }}</label>
                    <input class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" type="text" name="grade"
                           id="grade" value="{{ old('grade', $schoolFeeding->grade) }}" required>
                    @if($errors->has('grade'))
                        <span class="text-danger">{{ $errors->first('grade') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.grade_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.schoolFeeding.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender" required>
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\SchoolFeeding::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', $schoolFeeding->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="school_name">{{ trans('cruds.schoolFeeding.fields.school_name') }}</label>
                    <input class="form-control {{ $errors->has('school_name') ? 'is-invalid' : '' }}" type="text"
                           name="school_name" id="school_name"
                           value="{{ old('school_name', $schoolFeeding->school_name) }}" required>
                    @if($errors->has('school_name'))
                        <span class="text-danger">{{ $errors->first('school_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.school_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="academic_year">{{ trans('cruds.schoolFeeding.fields.academic_year') }}</label>
                    <input class="form-control {{ $errors->has('academic_year') ? 'is-invalid' : '' }}" type="text"
                           name="academic_year" id="academic_year"
                           value="{{ old('academic_year', $schoolFeeding->academic_year) }}" required>
                    @if($errors->has('academic_year'))
                        <span class="text-danger">{{ $errors->first('academic_year') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.academic_year_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="district">{{ trans('cruds.schoolFeeding.fields.district') }}</label>
                    <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text"
                           name="district" id="district" value="{{ old('district', $schoolFeeding->district) }}"
                           required>
                    @if($errors->has('district'))
                        <span class="text-danger">{{ $errors->first('district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.schoolFeeding.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', $schoolFeeding->sector) }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cell">{{ trans('cruds.schoolFeeding.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', $schoolFeeding->cell) }}" required>
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.schoolFeeding.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', $schoolFeeding->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="fathers_name">{{ trans('cruds.schoolFeeding.fields.fathers_name') }}</label>
                    <input class="form-control {{ $errors->has('fathers_name') ? 'is-invalid' : '' }}" type="text"
                           name="fathers_name" id="fathers_name"
                           value="{{ old('fathers_name', $schoolFeeding->fathers_name) }}">
                    @if($errors->has('fathers_name'))
                        <span class="text-danger">{{ $errors->first('fathers_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.fathers_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mothers_name">{{ trans('cruds.schoolFeeding.fields.mothers_name') }}</label>
                    <input class="form-control {{ $errors->has('mothers_name') ? 'is-invalid' : '' }}" type="text"
                           name="mothers_name" id="mothers_name"
                           value="{{ old('mothers_name', $schoolFeeding->mothers_name) }}">
                    @if($errors->has('mothers_name'))
                        <span class="text-danger">{{ $errors->first('mothers_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.mothers_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="home_phone">{{ trans('cruds.schoolFeeding.fields.home_phone') }}</label>
                    <input class="form-control {{ $errors->has('home_phone') ? 'is-invalid' : '' }}" type="text"
                           name="home_phone" id="home_phone"
                           value="{{ old('home_phone', $schoolFeeding->home_phone) }}">
                    @if($errors->has('home_phone'))
                        <span class="text-danger">{{ $errors->first('home_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.schoolFeeding.fields.home_phone_helper') }}</span>
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
