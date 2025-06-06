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
                    <label class="required" for="name">{{ trans('cruds.malnutrition.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.malnutrition.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Malnutrition::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.gender_helper') }}</span>
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
                    <label class="required" for="package_reception_date">{{ trans('cruds.malnutrition.fields.package_reception_date') }}</label>
                    <input class="form-control date {{ $errors->has('package_reception_date') ? 'is-invalid' : '' }}" type="text" name="package_reception_date" id="package_reception_date" value="{{ old('package_reception_date') }}" required>
                    @if($errors->has('package_reception_date'))
                        <span class="text-danger">{{ $errors->first('package_reception_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.malnutrition.fields.package_reception_date_helper') }}</span>
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
