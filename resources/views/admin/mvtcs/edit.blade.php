@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.mvtc.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.mvtcs.update", [$mvtc->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="reg_no">{{ trans('cruds.mvtc.fields.reg_no') }}</label>
                    <input class="form-control {{ $errors->has('reg_no') ? 'is-invalid' : '' }}" type="text" name="reg_no" id="reg_no" value="{{ old('reg_no', $mvtc->reg_no) }}">
                    @if($errors->has('reg_no'))
                        <span class="text-danger">{{ $errors->first('reg_no') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.reg_no_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.mvtc.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $mvtc->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.mvtc.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Mvtc::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $mvtc->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="student">{{ trans('cruds.mvtc.fields.student') }}</label>
                    <input class="form-control {{ $errors->has('student') ? 'is-invalid' : '' }}" type="text" name="student" id="student" value="{{ old('student', $mvtc->student) }}">
                    @if($errors->has('student'))
                        <span class="text-danger">{{ $errors->first('student') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.student_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="student_contact">{{ trans('cruds.mvtc.fields.student_contact') }}</label>
                    <input class="form-control {{ $errors->has('student_contact') ? 'is-invalid' : '' }}" type="text" name="student_contact" id="student_contact" value="{{ old('student_contact', $mvtc->student_contact) }}">
                    @if($errors->has('student_contact'))
                        <span class="text-danger">{{ $errors->first('student_contact') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.student_contact_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="trade">{{ trans('cruds.mvtc.fields.trade') }}</label>
                    <input class="form-control {{ $errors->has('trade') ? 'is-invalid' : '' }}" type="text" name="trade" id="trade" value="{{ old('trade', $mvtc->trade) }}">
                    @if($errors->has('trade'))
                        <span class="text-danger">{{ $errors->first('trade') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.trade_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.mvtc.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $mvtc->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.mvtc.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $mvtc->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.mvtc.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $mvtc->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="resident_district">{{ trans('cruds.mvtc.fields.resident_district') }}</label>
                    <input class="form-control {{ $errors->has('resident_district') ? 'is-invalid' : '' }}" type="text" name="resident_district" id="resident_district" value="{{ old('resident_district', $mvtc->resident_district) }}">
                    @if($errors->has('resident_district'))
                        <span class="text-danger">{{ $errors->first('resident_district') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.resident_district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="education_level">{{ trans('cruds.mvtc.fields.education_level') }}</label>
                    <input class="form-control {{ $errors->has('education_level') ? 'is-invalid' : '' }}" type="text" name="education_level" id="education_level" value="{{ old('education_level', $mvtc->education_level) }}">
                    @if($errors->has('education_level'))
                        <span class="text-danger">{{ $errors->first('education_level') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.education_level_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="payment_mode">{{ trans('cruds.mvtc.fields.payment_mode') }}</label>
                    <input class="form-control {{ $errors->has('payment_mode') ? 'is-invalid' : '' }}" type="text" name="payment_mode" id="payment_mode" value="{{ old('payment_mode', $mvtc->payment_mode) }}">
                    @if($errors->has('payment_mode'))
                        <span class="text-danger">{{ $errors->first('payment_mode') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.payment_mode_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="intake">{{ trans('cruds.mvtc.fields.intake') }}</label>
                    <input class="form-control {{ $errors->has('intake') ? 'is-invalid' : '' }}" type="text" name="intake" id="intake" value="{{ old('intake', $mvtc->intake) }}">
                    @if($errors->has('intake'))
                        <span class="text-danger">{{ $errors->first('intake') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.intake_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="graduation_date">{{ trans('cruds.mvtc.fields.graduation_date') }}</label>
                    <input class="form-control {{ $errors->has('graduation_date') ? 'is-invalid' : '' }}" type="text" name="graduation_date" id="graduation_date" value="{{ old('graduation_date', $mvtc->graduation_date) }}">
                    @if($errors->has('graduation_date'))
                        <span class="text-danger">{{ $errors->first('graduation_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.mvtc.fields.graduation_date_helper') }}</span>
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
