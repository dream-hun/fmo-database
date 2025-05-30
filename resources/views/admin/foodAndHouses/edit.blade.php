@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.foodAndHouse.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.food-and-houses.update", [$foodAndHouse->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.foodAndHouse.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $foodAndHouse->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="id_number">{{ trans('cruds.foodAndHouse.fields.id_number') }}</label>
                    <input class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" type="text" name="id_number" id="id_number" value="{{ old('id_number', $foodAndHouse->id_number) }}">
                    @if($errors->has('id_number'))
                        <span class="text-danger">{{ $errors->first('id_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.id_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="cell">{{ trans('cruds.foodAndHouse.fields.cell') }}</label>
                    <input class="form-control {{ $errors->has('cell') ? 'is-invalid' : '' }}" type="text" name="cell" id="cell" value="{{ old('cell', $foodAndHouse->cell) }}">
                    @if($errors->has('cell'))
                        <span class="text-danger">{{ $errors->first('cell') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.cell_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="village">{{ trans('cruds.foodAndHouse.fields.village') }}</label>
                    <input class="form-control {{ $errors->has('village') ? 'is-invalid' : '' }}" type="text" name="village" id="village" value="{{ old('village', $foodAndHouse->village) }}">
                    @if($errors->has('village'))
                        <span class="text-danger">{{ $errors->first('village') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.village_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ trans('cruds.foodAndHouse.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $foodAndHouse->phone_number) }}">
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="support">{{ trans('cruds.foodAndHouse.fields.support') }}</label>
                    <input class="form-control {{ $errors->has('support') ? 'is-invalid' : '' }}" type="text" name="support" id="support" value="{{ old('support', $foodAndHouse->support) }}">
                    @if($errors->has('support'))
                        <span class="text-danger">{{ $errors->first('support') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.support_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="date">{{ trans('cruds.foodAndHouse.fields.date') }}</label>
                    <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $foodAndHouse->date) }}">
                    @if($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.foodAndHouse.fields.date_helper') }}</span>
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
