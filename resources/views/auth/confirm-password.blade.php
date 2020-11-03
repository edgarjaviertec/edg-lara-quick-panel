@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
        <div class="w-100 mw-md">
            <div class="card border-0 shadow">
                <form method="POST" action="{{ route('password.confirm') }}">
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
                        <h1 class="h3 mb-3 text-center">{{ __('Confirm password') }}</h1>
                        <p>{{ __('For your security, please confirm your password to continue ') }}</p>
                        <div class="form-group mb-0">
                            <label>{{ __('Password') }}</label>
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   autocomplete="off"
                                   required/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center border-0">
                        <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Nevermind') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Confirm password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection