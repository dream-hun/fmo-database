@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.goat.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.goats.update', [$goat->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="names">{{ trans('cruds.goat.fields.names') }}</label>
                    <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names"
                        id="names" value="{{ old('names', $goat->names) }}" required>
                    @if ($errors->has('names'))
                        <span class="text-danger">{{ $errors->first('names') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.names_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.goat.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number"
                        name="id_number" id="id_number" value="{{ old('id_number', $goat->id_number) }}" step="1">
                    @if ($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.goat.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                        name="sector" id="sector" value="{{ old('sector', $goat->sector) }}">
                    @if ($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.goat.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text"
                        name="cell" id="cell" value="{{ old('cell', $goat->cell) }}">
                    @if ($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.goat.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                        name="village" id="village" value="{{ old('village', $goat->village) }}">
                    @if ($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="distribution_date">{{ trans('cruds.goat.fields.distribution_date') }}</label>
                    <input class="form-control date {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}"
                        type="text" name="distribution_date" id="distribution_date"
                        value="{{ old('distribution_date', $goat->distribution_date) }}">
                    @if ($errors->has('distribution_date'))
                        <span class="text-danger">{{ $errors->first('distribution_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.distribution_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="number_of_goats">{{ trans('cruds.goat.fields.number_of_goats') }}</label>
                    <input class="form-control {{ $errors->has('number_of_goats') ? 'is-invalid' : '' }}" type="number"
                        name="number_of_goats" id="number_of_goats"
                        value="{{ old('number_of_goats', $goat->number_of_goats) }}" step="1">
                    @if ($errors->has('number_of_goats'))
                        <span class="text-danger">{{ $errors->first('number_of_goats') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.number_of_goats_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.goat.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                        id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Goat::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('gender', $goat->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('pass_over') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="pass_over" value="0">
                        <input class="form-check-input" type="checkbox" name="pass_over" id="pass_over" value="1"
                            {{ $goat->pass_over || old('pass_over', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="pass_over">{{ trans('cruds.goat.fields.pass_over') }}</label>
                    </div>
                    @if ($errors->has('pass_over'))
                        <span class="text-danger">{{ $errors->first('pass_over') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.pass_over_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="comment">{{ trans('cruds.goat.fields.comment') }}</label>
                    <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $goat->comment) }}</textarea>
                    @if ($errors->has('comment'))
                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.comment_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.goat.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}"
                        name="project_id" id="project_id">
                        @foreach ($projects as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('project_id') ? old('project_id') : $goat->project->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.goat.fields.project_helper') }}</span>
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
