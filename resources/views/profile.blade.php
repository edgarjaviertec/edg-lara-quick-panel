@extends('layouts.dashboard')
@section('content')
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
        @include('profile.update-profile-information-form')
    @endif
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        @include('profile.update-password-form')
    @endif
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('profile.two-factor-authentication-form')
    @endif
@endsection