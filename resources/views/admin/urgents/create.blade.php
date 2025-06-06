@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.urgent.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.urgents.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.urgent.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.urgent.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Urgent::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.urgent.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', '') }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.urgent.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.urgent.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', '') }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.urgent.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ trans('cruds.urgent.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}">
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="support">{{ trans('cruds.urgent.fields.support') }}</label>
                    <input class="form-control {{ $errors->has('support') ? 'is-invalid' : '' }}" type="text" name="support" id="support" value="{{ old('support', '') }}">
                    @if($errors->has('support'))
                        <span class="text-danger">{{ $errors->first('support') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.support_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="support_date">{{ trans('cruds.urgent.fields.support_date') }}</label>
                    <input class="form-control date {{ $errors->has('support_date') ? 'is-invalid' : '' }}" type="text" name="support_date" id="support_date" value="{{ old('support_date') }}" required>
                    @if($errors->has('support_date'))
                        <span class="text-danger">{{ $errors->first('support_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.urgent.fields.support_date_helper') }}</span>
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
