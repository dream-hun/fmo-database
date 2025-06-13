@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.empowerment.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.empowerments.update", [$empowerment->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.empowerment.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $empowerment->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="sector">{{ trans('cruds.empowerment.fields.sector') }}</label>
                    <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', $empowerment->sector) }}" required>
                    @if($errors->has('sector'))
                        <span class="text-danger">{{ $errors->first('sector') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.sector_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="support">{{ trans('cruds.empowerment.fields.support') }}</label>
                    <input class="form-control {{ $errors->has('support') ? 'is-invalid' : '' }}" type="text" name="support" id="support" value="{{ old('support', $empowerment->support) }}" required>
                    @if($errors->has('support'))
                        <span class="text-danger">{{ $errors->first('support') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.support_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="support_date">{{ trans('cruds.empowerment.fields.support_date') }}</label>
                    <input class="form-control date {{ $errors->has('support_date') ? 'is-invalid' : '' }}" type="text" name="support_date" id="support_date" value="{{ old('support_date', $empowerment->support_date) }}" required>
                    @if($errors->has('support_date'))
                        <span class="text-danger">{{ $errors->first('support_date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.support_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="supported_children">{{ trans('cruds.empowerment.fields.supported_children') }}</label>
                    <input class="form-control {{ $errors->has('supported_children') ? 'is-invalid' : '' }}" type="number" name="supported_children" id="supported_children" value="{{ old('supported_children', $empowerment->supported_children) }}" step="1">
                    @if($errors->has('supported_children'))
                        <span class="text-danger">{{ $errors->first('supported_children') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.empowerment.fields.supported_children_helper') }}</span>
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
