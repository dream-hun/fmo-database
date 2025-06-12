@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.group.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.groups.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="code">{{ trans('cruds.group.fields.code') }}</label>
                    <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                           id="code" value="{{ old('code', '') }}" required>
                    @if($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.code_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.group.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="representer">{{ trans('cruds.group.fields.representer') }}</label>
                    <input class="form-control {{ $errors->has('representer') ? 'is-invalid' : '' }}" type="text"
                           name="representer" id="representer" value="{{ old('representer', '') }}">
                    @if($errors->has('representer'))
                        <span class="text-danger">{{ $errors->first('representer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.representer_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="representer_phone">{{ trans('cruds.group.fields.representer_phone') }}</label>
                    <input class="form-control {{ $errors->has('representer_phone') ? 'is-invalid' : '' }}" type="text"
                           name="representer_phone" id="representer_phone" value="{{ old('representer_phone', '') }}">
                    @if($errors->has('representer_phone'))
                        <span class="text-danger">{{ $errors->first('representer_phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.representer_phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mou_signed_at">{{ trans('cruds.group.fields.mou_signed_at') }}</label>
                    <input class="form-control date {{ $errors->has('mou_signed_at') ? 'is-invalid' : '' }}" type="text"
                           name="mou_signed_at" id="mou_signed_at" value="{{ old('mou_signed_at') }}">
                    @if($errors->has('mou_signed_at'))
                        <span class="text-danger">{{ $errors->first('mou_signed_at') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.mou_signed_at_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="number_of_members">{{ trans('cruds.group.fields.number_of_members') }}</label>
                    <input class="form-control {{ $errors->has('number_of_members') ? 'is-invalid' : '' }}"
                           type="number" name="number_of_members" id="number_of_members"
                           value="{{ old('number_of_members', '') }}" step="1">
                    @if($errors->has('number_of_members'))
                        <span class="text-danger">{{ $errors->first('number_of_members') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.group.fields.number_of_members_helper') }}</span>
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
