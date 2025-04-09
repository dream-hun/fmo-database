@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.girinka.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.girinkas.update', [$girinka->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="names">{{ trans('cruds.girinka.fields.names') }}</label>
                    <input class="form-control {{ $errors->has('names') ? 'is-invalid' : '' }}" type="text" name="names"
                        id="names" value="{{ old('names', $girinka->names) }}" required>
                    @if ($errors->has('names'))
                        <div class="invalid-feedback">
                            {{ $errors->first('names') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.names_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.girinka.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                        id="gender">
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Girinka::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('gender', $girinka->gender) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.gender_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.girinka.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="number"
                        name="id_number" id="id_number" value="{{ old('id_number', $girinka->id_number) }}" step="1">
                    @if ($errors->has('id_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sector">{{ trans('cruds.girinka.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                        name="sector" id="sector" value="{{ old('sector', $girinka->sector) }}">
                    @if ($errors->has('sector'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sector') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.girinka.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text"
                        name="village" id="village" value="{{ old('village', $girinka->village) }}">
                    @if ($errors->has('village'))
                        <div class="invalid-feedback">
                            {{ $errors->first('village') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.girinka.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text"
                        name="cell" id="cell" value="{{ old('cell', $girinka->cell) }}">
                    @if ($errors->has('cell'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cell') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="distribution_date">{{ trans('cruds.girinka.fields.distribution_date') }}</label>
                    <input class="form-control date {{ $errors->has('distribution_date') ? 'is-invalid' : '' }}"
                        type="text" name="distribution_date" id="distribution_date"
                        value="{{ old('distribution_date', $girinka->distribution_date) }}">
                    @if ($errors->has('distribution_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('distribution_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.distribution_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="m_status">{{ trans('cruds.girinka.fields.m_status') }}</label>
                    <input class="form-control {{ $errors->has('m_status') ? 'is-invalid' : '' }}" type="text"
                        name="m_status" id="m_status" value="{{ old('m_status', $girinka->m_status) }}">
                    @if ($errors->has('m_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('m_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.m_status_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="pass_over">{{ trans('cruds.girinka.fields.pass_over') }}</label>
                    <input class="form-control {{ $errors->has('pass_over') ? 'is-invalid' : '' }}" type="text"
                        name="pass_over" id="pass_over" value="{{ old('pass_over', $girinka->pass_over) }}">
                    @if ($errors->has('pass_over'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pass_over') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.pass_over_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="telephone">{{ trans('cruds.girinka.fields.telephone') }}</label>
                    <input class="form-control {{ $errors->has('telephone') ? 'is-invalid' : '' }}" type="text"
                        name="telephone" id="telephone" value="{{ old('telephone', $girinka->telephone) }}">
                    @if ($errors->has('telephone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telephone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.telephone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="comment">{{ trans('cruds.girinka.fields.comment') }}</label>
                    <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment" id="comment">{{ old('comment', $girinka->comment) }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.comment_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="project_id">{{ trans('cruds.girinka.fields.project') }}</label>
                    <select class="form-control select2 {{ $errors->has('project') ? 'is-invalid' : '' }}"
                        name="project_id" id="project_id">
                        @foreach ($projects as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('project_id') ? old('project_id') : $girinka->project->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('project'))
                        <div class="invalid-feedback">
                            {{ $errors->first('project') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.girinka.fields.project_helper') }}</span>
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
