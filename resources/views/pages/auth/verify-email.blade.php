@extends('layouts.default')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
        <div class="w-100 mw-md">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-3 alert alert-success bg-success text-white border-0 shadow">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <div class="card border-0 shadow">
                    <div class="card-body">
                        <h1 class="h4 mb-3 text-center">{{__("Verify your email address")}}</h1>
                        <p class="mb-0">{{ __("A verification email has been sent to your email address. Click the confirm link provided in the email. If you didn't receive the email, we will gladly send you another.") }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center border-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                {{ __('Logout') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                {{ __('Resend verification email') }}
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection