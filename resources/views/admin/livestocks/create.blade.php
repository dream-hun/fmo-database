@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.livestock.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.livestocks.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.livestock.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.livestock.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text"
                           name="id_number" id="id_number" value="{{ old('id_number', '') }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.livestock.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.livestock.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="distribution_date">{{ trans('cruds.livestock.fields.distribution_date') }}</label>
                    <input class="form-control date {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}"
                           type="text" name="distribution_date" id="distribution_date"
                           value="{{ old('distribution_date') }}" required>
                    @if($errors->has('distribution_date'))
                        <span class="text-danger">{{ $errors->first('distribution_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.distribution_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="type">{{ trans('cruds.livestock.fields.type') }}</label>
                    <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type"
                           id="type" value="{{ old('type', '') }}" required>
                    @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="number">{{ trans('cruds.livestock.fields.number') }}</label>
                    <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number"
                           name="number" id="number" value="{{ old('number', '') }}" step="1" required>
                    @if($errors->has('number'))
                        <span class="text-danger">{{ $errors->first('number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.livestock.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender">
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Livestock::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.livestock.fields.gender_helper') }}</span>
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
