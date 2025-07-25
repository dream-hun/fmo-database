@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.toolkit.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.toolkits.update", [$toolkit->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.toolkit.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $toolkit->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.toolkit.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Toolkit::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $toolkit->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.toolkit.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $toolkit->id_number) }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="business_name">{{ trans('cruds.toolkit.fields.business_name') }}</label>
                    <input class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}" type="text" name="business_name" id="business_name" value="{{ old('business_name', $toolkit->business_name) }}" required>
                    @if($errors->has('business_name'))
                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.business_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.toolkit.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $toolkit->telephone) }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.toolkit.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $toolkit->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.toolkit.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $toolkit->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.toolkit.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $toolkit->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cohort">{{ trans('cruds.toolkit.fields.cohort') }}</label>
                    <input class="form-control date {{ $errors->has('cohort') ? 'is-invalid' : '' }}" type="text" name="cohort" id="cohort" value="{{ old('cohort', $toolkit->cohort) }}" required>
                    @if($errors->has('cohort'))
                        <span class="text-danger">{{ $errors->first('cohort') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.cohort_helper') }}</span>
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
