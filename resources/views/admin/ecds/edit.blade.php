@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.ecd.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.ecds.update", [$ecd->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.ecd.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $ecd->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.ecd.fields.grade') }}</label>
                    <select class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" name="grade"
                            id="grade">
                        <option value
                                disabled {{ old('grade', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Ecd::GRADE_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('grade', $ecd->grade) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('grade'))
                        <span class="text-danger">{{ $errors->first('grade') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.grade_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.ecd.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender" required>
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Ecd::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', $ecd->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="academic_year">{{ trans('cruds.ecd.fields.academic_year') }}</label>
                    <input class="form-control {{ $errors->has('academic_year') ? 'is-invalid' : '' }}" type="text"
                           name="academic_year" id="academic_year"
                           value="{{ old('academic_year', $ecd->academic_year) }}" required>
                    @if($errors->has('academic_year'))
                        <span class="text-danger">{{ $errors->first('academic_year') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.academic_year_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.ecd.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', $ecd->sector) }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cell">{{ trans('cruds.ecd.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', $ecd->cell) }}" required>
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="village">{{ trans('cruds.ecd.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', $ecd->village) }}" required>
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="father_name">{{ trans('cruds.ecd.fields.father_name') }}</label>
                    <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text"
                           name="father_name" id="father_name" value="{{ old('father_name', $ecd->father_name) }}">
                    @if($errors->has('father_name'))
                        <span class="text-danger">{{ $errors->first('father_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.father_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mother_name">{{ trans('cruds.ecd.fields.mother_name') }}</label>
                    <input class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}" type="text"
                           name="mother_name" id="mother_name" value="{{ old('mother_name', $ecd->mother_name) }}">
                    @if($errors->has('mother_name'))
                        <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.mother_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="home_phone">{{ trans('cruds.ecd.fields.home_phone') }}</label>
                    <input class="form-control {{ $errors->has('home_phone') ? 'is-invalid' : '' }}" type="text"
                           name="home_phone" id="home_phone" value="{{ old('home_phone', $ecd->home_phone) }}">
                    @if($errors->has('home_phone'))
                        <span class="text-danger">{{ $errors->first('home_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ecd.fields.home_phone_helper') }}</span>
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
