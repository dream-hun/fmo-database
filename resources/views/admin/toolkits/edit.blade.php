@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.toolkit.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.toolkits.update", [$toolKit->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.toolkit.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}" name="project_id" id="project_id">
                        @foreach($projects as $id => $entry)
                            <option value="{{ $id }}" {{ (old('project_id') ? old('project_id') : $toolKit->project->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('project'))
                        <span class="text-danger">{{ $errors->first('project') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.project_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.toolkit.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $toolKit->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="gender">{{ trans('cruds.toolkit.fields.gender') }}</label>
                    <input class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" type="text" name="gender" id="gender" value="{{ old('gender', $toolKit->gender) }}">
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="identification_number">{{ trans('cruds.toolkit.fields.identification_number') }}</label>
                    <input class="form-control {{ $errors->has('identification_number') ? 'is-invalid' : '' }}" type="text" name="identification_number" id="identification_number" value="{{ old('identification_number', $toolKit->identification_number) }}">
                    @if($errors->has('identification_number'))
                        <span class="text-danger">{{ $errors->first('identification_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.identification_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ trans('cruds.toolkit.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $toolKit->phone_number) }}">
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tvet_attended">{{ trans('cruds.toolkit.fields.tvet_attended') }}</label>
                    <input class="form-control {{ $errors->has('tvet_attended') ? 'is-invalid' : '' }}" type="text" name="tvet_attended" id="tvet_attended" value="{{ old('tvet_attended', $toolKit->tvet_attended) }}">
                    @if($errors->has('tvet_attended'))
                        <span class="text-danger">{{ $errors->first('tvet_attended') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.tvet_attended_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="option">{{ trans('cruds.toolkit.fields.option') }}</label>
                    <input class="form-control {{ $errors->has('option') ? 'is-invalid' : '' }}" type="text" name="option" id="option" value="{{ old('option', $toolKit->option) }}">
                    @if($errors->has('option'))
                        <span class="text-danger">{{ $errors->first('option') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.option_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="level">{{ trans('cruds.toolkit.fields.level') }}</label>
                    <input class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" type="text" name="level" id="level" value="{{ old('level', $toolKit->level) }}">
                    @if($errors->has('level'))
                        <span class="text-danger">{{ $errors->first('level') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.level_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="training_intake">{{ trans('cruds.toolkit.fields.training_intake') }}</label>
                    <input class="form-control {{ $errors->has('training_intake') ? 'is-invalid' : '' }}" type="text" name="training_intake" id="training_intake" value="{{ old('training_intake', $toolKit->training_intake) }}">
                    @if($errors->has('training_intake'))
                        <span class="text-danger">{{ $errors->first('training_intake') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.training_intake_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="reception_date">{{ trans('cruds.toolkit.fields.reception_date') }}</label>
                    <input class="form-control {{ $errors->has('reception_date') ? 'is-invalid' : '' }}" type="text" name="reception_date" id="reception_date" value="{{ old('reception_date', $toolKit->reception_date) }}">
                    @if($errors->has('reception_date'))
                        <span class="text-danger">{{ $errors->first('reception_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.reception_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="toolkit_received">{{ trans('cruds.toolkit.fields.toolkit_received') }}</label>
                    <input class="form-control {{ $errors->has('toolkit_received') ? 'is-invalid' : '' }}" type="text" name="toolkit_received" id="toolkit_received" value="{{ old('toolkit_received', $toolKit->toolkit_received) }}">
                    @if($errors->has('toolkit_received'))
                        <span class="text-danger">{{ $errors->first('toolkit_received') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.toolkit_received_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="toolkit_cost">{{ trans('cruds.toolkit.fields.toolkit_cost') }}</label>
                    <input class="form-control {{ $errors->has('toolkit_cost') ? 'is-invalid' : '' }}" type="number" step="0.01" name="toolkit_cost" id="toolkit_cost" value="{{ old('toolkit_cost', $toolKit->toolkit_cost) }}">
                    @if($errors->has('toolkit_cost'))
                        <span class="text-danger">{{ $errors->first('toolkit_cost') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.toolkit_cost_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="subsidized_percent">{{ trans('cruds.toolkit.fields.subsidized_percent') }}</label>
                    <input class="form-control {{ $errors->has('subsidized_percent') ? 'is-invalid' : '' }}" type="number" step="0.01" name="subsidized_percent" id="subsidized_percent" value="{{ old('subsidized_percent', $toolKit->subsidized_percent) }}">
                    @if($errors->has('subsidized_percent'))
                        <span class="text-danger">{{ $errors->first('subsidized_percent') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.subsidized_percent_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.toolkit.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $toolKit->sector) }}">
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="total">{{ trans('cruds.toolkit.fields.total') }}</label>
                    <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" step="0.01" name="total" id="total" value="{{ old('total', $toolKit->total) }}">
                    @if($errors->has('total'))
                        <span class="text-danger">{{ $errors->first('total') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.toolkit.fields.total_helper') }}</span>
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
