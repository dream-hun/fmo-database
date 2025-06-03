@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.training.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trainings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.training.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.training.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Training::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="national">{{ trans('cruds.training.fields.national') }}</label>
                <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" value="{{ old('national', '') }}">
                @if($errors->has('national'))
                    <span class="text-danger">{{ $errors->first('national') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.national_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district">{{ trans('cruds.training.fields.district') }}</label>
                <input class="form-control {{ $errors->has('district') ? 'is-invalid' : '' }}" type="text" name="district" id="district" value="{{ old('district', '') }}">
                @if($errors->has('district'))
                    <span class="text-danger">{{ $errors->first('district') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sector">{{ trans('cruds.training.fields.sector') }}</label>
                <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                @if($errors->has('sector'))
                    <span class="text-danger">{{ $errors->first('sector') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.sector_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telephone">{{ trans('cruds.training.fields.telephone') }}</label>
                <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}">
                @if($errors->has('telephone'))
                    <span class="text-danger">{{ $errors->first('telephone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.telephone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="training_given">{{ trans('cruds.training.fields.training_given') }}</label>
                <input class="form-control {{ $errors->has('training_given') ? 'is-invalid' : '' }}" type="text" name="training_given" id="training_given" value="{{ old('training_given', '') }}">
                @if($errors->has('training_given'))
                    <span class="text-danger">{{ $errors->first('training_given') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.training_given_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="position">{{ trans('cruds.training.fields.position') }}</label>
                <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text" name="position" id="position" value="{{ old('position', '') }}">
                @if($errors->has('position'))
                    <span class="text-danger">{{ $errors->first('position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="institution">{{ trans('cruds.training.fields.institution') }}</label>
                <input class="form-control {{ $errors->has('institution') ? 'is-invalid' : '' }}" type="text" name="institution" id="institution" value="{{ old('institution', '') }}">
                @if($errors->has('institution'))
                    <span class="text-danger">{{ $errors->first('institution') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.institution_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="training_date">{{ trans('cruds.training.fields.training_date') }}</label>
                <input class="form-control date {{ $errors->has('training_date') ? 'is-invalid' : '' }}" type="text" name="training_date" id="training_date" value="{{ old('training_date') }}">
                @if($errors->has('training_date'))
                    <span class="text-danger">{{ $errors->first('training_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.training.fields.training_date_helper') }}</span>
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