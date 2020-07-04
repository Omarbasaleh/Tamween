@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.worker.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.workers.update", [$worker->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="civil">{{ trans('cruds.worker.fields.civil') }}</label>
                <input class="form-control {{ $errors->has('civil') ? 'is-invalid' : '' }}" type="text" name="civil" id="civil" value="{{ old('civil', $worker->civil) }}">
                @if($errors->has('civil'))
                    <span class="text-danger">{{ $errors->first('civil') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.worker.fields.civil_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.worker.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $worker->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.worker.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.worker.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $worker->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.worker.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.worker.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="text" name="password" id="password" value="{{ old('password', $worker->password) }}">
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.worker.fields.password_helper') }}</span>
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