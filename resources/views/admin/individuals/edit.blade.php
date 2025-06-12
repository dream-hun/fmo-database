@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.individual.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.individuals.update", [$individual->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.individual.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $individual->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.individual.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender" required>
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Individual::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', $individual->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="id_number">{{ trans('cruds.individual.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text"
                           name="id_number" id="id_number" value="{{ old('id_number', $individual->id_number) }}"
                           required>
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="telephone">{{ trans('cruds.individual.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text"
                           name="telephone" id="telephone" value="{{ old('telephone', $individual->telephone) }}"
                           required>
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.individual.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', $individual->sector) }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cell">{{ trans('cruds.individual.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', $individual->cell) }}" required>
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="village">{{ trans('cruds.individual.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', $individual->village) }}" required>
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.individual.fields.village_helper') }}</span>
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
