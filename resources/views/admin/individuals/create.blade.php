@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.individual.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.individuals.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.individual.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.individual.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', '') }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="business_name">{{ trans('cruds.individual.fields.business_name') }}</label>
                    <input class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}" type="text" name="business_name" id="business_name" value="{{ old('business_name', '') }}">
                    @if($errors->has('business_name'))
                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.business_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.individual.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', '') }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="guardian">{{ trans('cruds.individual.fields.guardian') }}</label>
                    <input class="form-control {{ $errors->has('guardian') ? 'is-invalid' : '' }}" type="text" name="guardian" id="guardian" value="{{ old('guardian', '') }}">
                    @if($errors->has('guardian'))
                        <span class="text-danger">{{ $errors->first('guardian') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.guardian_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="guardian_phone">{{ trans('cruds.individual.fields.guardian_phone') }}</label>
                    <input class="form-control {{ $errors->has('guardian_phone') ? 'is-invalid' : '' }}" type="text" name="guardian_phone" id="guardian_phone" value="{{ old('guardian_phone', '') }}">
                    @if($errors->has('guardian_phone'))
                        <span class="text-danger">{{ $errors->first('guardian_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.guardian_phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.individual.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.individual.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', '') }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.individual.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', '') }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="loan_amount">{{ trans('cruds.individual.fields.loan_amount') }}</label>
                    <input class="form-control {{ $errors->has('loan_amount') ? 'is-invalid' : '' }}" type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount', '') }}" step="1">
                    @if($errors->has('loan_amount'))
                        <span class="text-danger">{{ $errors->first('loan_amount') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.loan_amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="loan_date">{{ trans('cruds.individual.fields.loan_date') }}</label>
                    <input class="form-control date {{ $errors->has('loan_date') ? 'is-invalid' : '' }}" type="text" name="loan_date" id="loan_date" value="{{ old('loan_date') }}" required>
                    @if($errors->has('loan_date'))
                        <span class="text-danger">{{ $errors->first('loan_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.loan_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.individual.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Individual::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.gender_helper') }}</span>
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
