@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.fruit.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.fruits.update", [$fruit->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="surname">{{ trans('cruds.fruit.fields.surname') }}</label>
                    <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname" id="surname" value="{{ old('surname', $fruit->surname) }}" required>
                    @if($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.surname_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.fruit.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $fruit->first_name) }}" required>
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="gender">{{ trans('cruds.fruit.fields.gender') }}</label>
                    <input class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" type="text" name="gender" id="gender" value="{{ old('gender', $fruit->gender) }}">
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="national">{{ trans('cruds.fruit.fields.national') }}</label>
                    <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" value="{{ old('national', $fruit->national) }}">
                    @if($errors->has('national'))
                        <span class="text-danger">{{ $errors->first('national') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.national_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.fruit.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $fruit->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.fruit.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $fruit->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.fruit.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $fruit->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mangoes">{{ trans('cruds.fruit.fields.mangoes') }}</label>
                    <input class="form-control {{ $errors->has('mangoes') ? 'is-invalid' : '' }}" type="number" name="mangoes" id="mangoes" value="{{ old('mangoes', $fruit->mangoes) }}" step="1">
                    @if($errors->has('mangoes'))
                        <span class="text-danger">{{ $errors->first('mangoes') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.mangoes_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="avocado">{{ trans('cruds.fruit.fields.avocado') }}</label>
                    <input class="form-control {{ $errors->has('avocado') ? 'is-invalid' : '' }}" type="number" name="avocado" id="avocado" value="{{ old('avocado', $fruit->avocado) }}" step="1">
                    @if($errors->has('avocado'))
                        <span class="text-danger">{{ $errors->first('avocado') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.avocado_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="papaya">{{ trans('cruds.fruit.fields.papaya') }}</label>
                    <input class="form-control {{ $errors->has('papaya') ? 'is-invalid' : '' }}" type="number" name="papaya" id="papaya" value="{{ old('papaya', $fruit->papaya) }}" step="1">
                    @if($errors->has('papaya'))
                        <span class="text-danger">{{ $errors->first('papaya') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.papaya_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="oranges">{{ trans('cruds.fruit.fields.oranges') }}</label>
                    <input class="form-control {{ $errors->has('oranges') ? 'is-invalid' : '' }}" type="number" name="oranges" id="oranges" value="{{ old('oranges', $fruit->oranges) }}" step="1">
                    @if($errors->has('oranges'))
                        <span class="text-danger">{{ $errors->first('oranges') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.oranges_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.fruit.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text" name="telephone" id="telephone" value="{{ old('telephone', $fruit->telephone) }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="distribution_date">{{ trans('cruds.fruit.fields.distribution_date') }}</label>
                    <input class="form-control {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}" type="text" name="distribution_date" id="distribution_date" value="{{ old('distribution_date', $fruit->distribution_date) }}">
                    @if($errors->has('distribution_date'))
                        <span class="text-danger">{{ $errors->first('distribution_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.distribution_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="project_id">{{ trans('cruds.fruit.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id" required>
                        @foreach($projects as $id => $entry)
                            <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $fruit->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.project_helper') }}</span>
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
