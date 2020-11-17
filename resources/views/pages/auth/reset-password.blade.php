@extends('layouts.default')

@section('title', 'Password Reset')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
        <div class="w-100 mw-md">
            @if ($errors->any())
                <div class="mb-3 alert alert-danger bg-danger text-white border-0 shadow">
                    <p class="font-weight-bold mb-2">{{ __('Whoops! Something went wrong.') }}</p>
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
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <label>{{ __('Email') }}</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ old('email', $request->email) }}"
                                   autofocus
                                   autocomplete="off"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   autocomplete="off"
                                   required/>
                        </div>
                        <div class="form-group mb-0">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   autocomplete="off"
                                   required/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center border-0">
                        <a href="{{ route('homepage') }}" class="btn btn-link">{{ __('Go home') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection