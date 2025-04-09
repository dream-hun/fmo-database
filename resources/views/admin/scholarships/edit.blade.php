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
                    <label class="required" for="surname">{{ trans('cruds.scholarship.fields.surname') }}</label>
                    <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', $scholarship->surname) }}" required>
                    @if($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.surname_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.scholarship.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $scholarship->first_name) }}" required>
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.scholarship.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
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
                    <label class="required" for="id_number">{{ trans('cruds.scholarship.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number" name="id_number" id="id_number" value="{{ old('id_number', $scholarship->id_number) }}" step="1" required>
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
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $scholarship->email) }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="school_to_attend">{{ trans('cruds.scholarship.fields.school_to_attend') }}</label>
                    <input class="form-control {{ $errors->has('school_to_attend') ? 'is-invalid' : '' }}" type="text" name="school_to_attend" id="school_to_attend" value="{{ old('school_to_attend', $scholarship->school_to_attend) }}">
                    @if($errors->has('school_to_attend'))
                        <span class="text-danger">{{ $errors->first('school_to_attend') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.school_to_attend_helper') }}</span>
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
                    <label for="program_duration">{{ trans('cruds.scholarship.fields.program_duration') }}</label>
                    <input class="form-control {{ $errors->has('program_duration') ? 'is-invalid' : '' }}" type="text" name="program_duration" id="program_duration" value="{{ old('program_duration', $scholarship->program_duration) }}">
                    @if($errors->has('program_duration'))
                        <span class="text-danger">{{ $errors->first('program_duration') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.program_duration_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="budget_up_to_completion">{{ trans('cruds.scholarship.fields.budget_up_to_completion') }}</label>
                    <input class="form-control {{ $errors->has('budget_up_to_completion') ? 'is-invalid' : '' }}" type="text" name="budget_up_to_completion" id="budget_up_to_completion" value="{{ old('budget_up_to_completion', $scholarship->budget_up_to_completion) }}">
                    @if($errors->has('budget_up_to_completion'))
                        <span class="text-danger">{{ $errors->first('budget_up_to_completion') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.budget_up_to_completion_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="year_of_entrance">{{ trans('cruds.scholarship.fields.year_of_entrance') }}</label>
                    <input class="form-control {{ $errors->has('year_of_entrance') ? 'is-invalid' : '' }}" type="number" name="year_of_entrance" id="year_of_entrance" value="{{ old('year_of_entrance', $scholarship->year_of_entrance) }}" step="1">
                    @if($errors->has('year_of_entrance'))
                        <span class="text-danger">{{ $errors->first('year_of_entrance') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.year_of_entrance_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="intake">{{ trans('cruds.scholarship.fields.intake') }}</label>
                    <input class="form-control {{ $errors->has('intake') ? 'is-invalid' : '' }}" type="text" name="intake" id="intake" value="{{ old('intake', $scholarship->intake) }}">
                    @if($errors->has('intake'))
                        <span class="text-danger">{{ $errors->first('intake') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.intake_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="school_contact">{{ trans('cruds.scholarship.fields.school_contact') }}</label>
                    <input class="form-control {{ $errors->has('school_contact') ? 'is-invalid' : '' }}" type="text" name="school_contact" id="school_contact" value="{{ old('school_contact', $scholarship->school_contact) }}">
                    @if($errors->has('school_contact'))
                        <span class="text-danger">{{ $errors->first('school_contact') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.scholarship.fields.school_contact_helper') }}</span>
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
