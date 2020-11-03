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
                    <div class="card-footer d-flex justify-content-center align-items-center border-0">
                        <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('homepage') }}" class="btn btn-link text-white d-flex align-items-center">
                    <svg viewBox="0 0 576 512" class="small-icon mr-2">
                        <path fill="currentColor"
                              d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"
                              class=""></path>
                    </svg>
                    <span>Go to homepage</span>
                </a>
            </div>
        </div>
    </div>
@endsection