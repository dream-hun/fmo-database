@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.transaction.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.transactions.update", [$transaction->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="group_id">{{ trans('cruds.transaction.fields.group') }}</label>
                    <select class="form-control select2 {{ $errors->has('group') ? 'is-invalid' : '' }}" name="group_id"
                            id="group_id" required>
                        @foreach($groups as $id => $entry)
                            <option
                                value="{{ $id }}" {{ (old('group_id') ? old('group_id') : $transaction->group->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('group'))
                        <span class="text-danger">{{ $errors->first('group') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.group_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="member_id">{{ trans('cruds.transaction.fields.member') }}</label>
                    <select class="form-control select2 {{ $errors->has('member') ? 'is-invalid' : '' }}"
                            name="member_id" id="member_id" required>
                        @foreach($members as $id => $entry)
                            <option
                                value="{{ $id }}" {{ (old('member_id') ? old('member_id') : $transaction->member->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('member'))
                        <span class="text-danger">{{ $errors->first('member') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.member_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number"
                           name="amount" id="amount" value="{{ old('amount', $transaction->amount) }}" step="1"
                           required>
                    @if($errors->has('amount'))
                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="done_at">{{ trans('cruds.transaction.fields.done_at') }}</label>
                    <input class="form-control date {{ $errors->has('done_at') ? 'is-invalid' : '' }}" type="text"
                           name="done_at" id="done_at" value="{{ old('done_at', $transaction->done_at) }}" required>
                    @if($errors->has('done_at'))
                        <span class="text-danger">{{ $errors->first('done_at') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.done_at_helper') }}</span>
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
