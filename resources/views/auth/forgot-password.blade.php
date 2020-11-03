@extends('layouts.app')

@section('title','Forgot your password?')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
        <div class="w-100 mw-md">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card border-0 shadow">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="mb-3 text-danger">
                                <p>{{ __('Whoops! Something went wrong.') }}</p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        <div class="form-group mb-0">
                            <label>{{ __('Email') }}</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ old('email') }}"
                                   autocomplete="off"
                                   autofocus
                                   required/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center border-0">
                        <a href="{{ route('homepage') }}" class="btn btn-link"> Go to homepage </a>
                        <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection