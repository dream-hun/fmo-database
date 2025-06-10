@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.zamuka.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.zamukas.update", [$zamuka->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required"
                           for="head_of_household_name">{{ trans('cruds.zamuka.fields.head_of_household_name') }}</label>
                    <input class="form-control {{ $errors->has('head_of_household_name') ? 'is-invalid' : '' }}"
                           type="text" name="head_of_household_name" id="head_of_household_name"
                           value="{{ old('head_of_household_name', $zamuka->head_of_household_name) }}" required>
                    @if($errors->has('head_of_household_name'))
                        <span class="text-danger">{{ $errors->first('head_of_household_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.head_of_household_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="household_id_number">{{ trans('cruds.zamuka.fields.household_id_number') }}</label>
                    <input class="form-control {{ $errors->has('household_id_number') ? 'is-invalid' : '' }}"
                           type="text" name="household_id_number" id="household_id_number"
                           value="{{ old('household_id_number', $zamuka->household_id_number) }}">
                    @if($errors->has('household_id_number'))
                        <span class="text-danger">{{ $errors->first('household_id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.household_id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="spouse_name">{{ trans('cruds.zamuka.fields.spouse_name') }}</label>
                    <input class="form-control {{ $errors->has('spouse_name') ? 'is-invalid' : '' }}" type="text"
                           name="spouse_name" id="spouse_name" value="{{ old('spouse_name', $zamuka->spouse_name) }}">
                    @if($errors->has('spouse_name'))
                        <span class="text-danger">{{ $errors->first('spouse_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.spouse_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="spouse_id_number">{{ trans('cruds.zamuka.fields.spouse_id_number') }}</label>
                    <input class="form-control {{ $errors->has('spouse_id_number') ? 'is-invalid' : '' }}" type="text"
                           name="spouse_id_number" id="spouse_id_number"
                           value="{{ old('spouse_id_number', $zamuka->spouse_id_number) }}">
                    @if($errors->has('spouse_id_number'))
                        <span class="text-danger">{{ $errors->first('spouse_id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.spouse_id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.zamuka.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', $zamuka->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.zamuka.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', $zamuka->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.zamuka.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', $zamuka->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="house_hold_phone">{{ trans('cruds.zamuka.fields.house_hold_phone') }}</label>
                    <input class="form-control {{ $errors->has('house_hold_phone') ? 'is-invalid' : '' }}" type="text"
                           name="house_hold_phone" id="house_hold_phone"
                           value="{{ old('house_hold_phone', $zamuka->house_hold_phone) }}">
                    @if($errors->has('house_hold_phone'))
                        <span class="text-danger">{{ $errors->first('house_hold_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.house_hold_phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="family_size">{{ trans('cruds.zamuka.fields.family_size') }}</label>
                    <input class="form-control {{ $errors->has('family_size') ? 'is-invalid' : '' }}" type="number"
                           name="family_size" id="family_size" value="{{ old('family_size', $zamuka->family_size) }}"
                           step="1">
                    @if($errors->has('family_size'))
                        <span class="text-danger">{{ $errors->first('family_size') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.family_size_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="entrance_year">{{ trans('cruds.zamuka.fields.entrance_year') }}</label>
                    <input class="form-control {{ $errors->has('entrance_year') ? 'is-invalid' : '' }}" type="number"
                           name="entrance_year" id="entrance_year"
                           value="{{ old('entrance_year', $zamuka->entrance_year) }}" step="1">
                    @if($errors->has('entrance_year'))
                        <span class="text-danger">{{ $errors->first('entrance_year') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.zamuka.fields.entrance_year_helper') }}</span>
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
