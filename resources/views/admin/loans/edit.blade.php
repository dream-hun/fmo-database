@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.loan.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.loans.update", [$loan->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="individual_id">{{ trans('cruds.loan.fields.individual') }}</label>
                    <select class="form-control select2 {{ $errors->has('individual') ? 'is-invalid' : '' }}"
                            name="individual_id" id="individual_id" required>
                        @foreach($individuals as $id => $entry)
                            <option
                                value="{{ $id }}" {{ (old('individual_id') ? old('individual_id') : $loan->individual->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('individual'))
                        <span class="text-danger">{{ $errors->first('individual') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.loan.fields.individual_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="business_name">{{ trans('cruds.loan.fields.business_name') }}</label>
                    <input class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}" type="text"
                           name="business_name" id="business_name"
                           value="{{ old('business_name', $loan->business_name) }}">
                    @if($errors->has('business_name'))
                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.loan.fields.business_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('cruds.loan.fields.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number"
                           name="amount" id="amount" value="{{ old('amount', $loan->amount) }}" step="1" required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.loan.fields.amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="done_at">{{ trans('cruds.loan.fields.done_at') }}</label>
                    <input class="form-control date {{ $errors->has('done_at') ? 'is-invalid' : '' }}" type="text"
                           name="done_at" id="done_at" value="{{ old('done_at', $loan->done_at) }}" required>
                    @if($errors->has('done_at'))
                        <span class="text-danger">{{ $errors->first('done_at') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.loan.fields.done_at_helper') }}</span>
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
