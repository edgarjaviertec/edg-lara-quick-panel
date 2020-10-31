@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
    <div class="w-100 mw-md">
        @if ($errors->any())
        <div class="alert alert-danger">
            <h3 class="alert-heading h5">{{ __('Whoops! Something went wrong.') }}</h3>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card border-0 shadow">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="card-body">
                    <h1 class="h3 mb-4 text-center">Password Reset</h1>
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="form-group">
                        <label>{{ __('Email') }}</label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $request->email) }}" required autofocus />
                    </div>
                    <div class="form-group">
                        <label>{{ __('Password') }}</label>
                        <input type="password" class="form-control" name="password" required
                            autocomplete="new-password" />
                    </div>
                    <div class="form-group mb-0">
                        <label>{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" required
                            autocomplete="new-password" />
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center border-0">
                    <a href="{{ route('homepage') }}"class="btn btn-link">Go to homepage</a>
                    <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection