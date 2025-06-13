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
                    <label class="required" for="name">{{ trans('cruds.fruit.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $fruit->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.fruit.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                            id="gender" required>
                        <option value
                                disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Fruit::GENDER_SELECT as $key => $label)
                            <option
                                value="{{ $key }}" {{ old('gender', $fruit->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="id_number">{{ trans('cruds.fruit.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text"
                           name="id_number" id="id_number" value="{{ old('id_number', $fruit->id_number) }}" required>
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.fruit.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                           name="sector" id="sector" value="{{ old('sector', $fruit->sector) }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="cell">{{ trans('cruds.fruit.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell"
                           id="cell" value="{{ old('cell', $fruit->cell) }}" required>
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="village">{{ trans('cruds.fruit.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                           name="village" id="village" value="{{ old('village', $fruit->village) }}" required>
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mangoes">{{ trans('cruds.fruit.fields.mangoes') }}</label>
                    <input class="form-control {{ $errors->has('mangoes') ? 'is-invalid' : '' }}" type="text"
                           name="mangoes" id="mangoes" value="{{ old('mangoes', $fruit->mangoes) }}">
                    @if($errors->has('mangoes'))
                        <span class="text-danger">{{ $errors->first('mangoes') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.mangoes_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="avocado">{{ trans('cruds.fruit.fields.avocado') }}</label>
                    <input class="form-control {{ $errors->has('avocado') ? 'is-invalid' : '' }}" type="text"
                           name="avocado" id="avocado" value="{{ old('avocado', $fruit->avocado) }}">
                    @if($errors->has('avocado'))
                        <span class="text-danger">{{ $errors->first('avocado') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.avocado_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="papaya">{{ trans('cruds.fruit.fields.papaya') }}</label>
                    <input class="form-control {{ $errors->has('papaya') ? 'is-invalid' : '' }}" type="text"
                           name="papaya" id="papaya" value="{{ old('papaya', $fruit->papaya) }}">
                    @if($errors->has('papaya'))
                        <span class="text-danger">{{ $errors->first('papaya') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.papaya_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="oranges">{{ trans('cruds.fruit.fields.oranges') }}</label>
                    <input class="form-control {{ $errors->has('oranges') ? 'is-invalid' : '' }}" type="text"
                           name="oranges" id="oranges" value="{{ old('oranges', $fruit->oranges) }}">
                    @if($errors->has('oranges'))
                        <span class="text-danger">{{ $errors->first('oranges') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.oranges_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.fruit.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text"
                           name="telephone" id="telephone" value="{{ old('telephone', $fruit->telephone) }}">
                    @if($errors->has('telephone'))
                        <span class="text-danger">{{ $errors->first('telephone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                           for="distribution_date">{{ trans('cruds.fruit.fields.distribution_date') }}</label>
                    <input class="form-control date {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}"
                           type="text" name="distribution_date" id="distribution_date"
                           value="{{ old('distribution_date', $fruit->distribution_date) }}" required>
                    @if($errors->has('distribution_date'))
                        <span class="text-danger">{{ $errors->first('distribution_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.fruit.fields.distribution_date_helper') }}</span>
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
