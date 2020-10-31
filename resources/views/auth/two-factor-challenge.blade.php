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
            <div class="card border shadow">
                <form method="POST" action="{{ url('/two-factor-challenge') }}">
                    @csrf
                    <div class="card-body">
                        {{--
                            Do not show both of these fields, together. It's recommended
                            that you only show one field at a time and use some logic
                            to toggle the visibility of each field
                        --}}
                        <p>{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</p>
                        <div class="form-group">
                            <label>{{ __('Code') }}</label>
                            <input type="text" class="form-control" name="code" autofocus autocomplete="off" />
                        </div>
                        {{-- ** OR ** --}}
                        <p>{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</p>
                        <div class="form-group mb-0">
                            <label>{{ __('Recovery Code') }}</label>
                            <input type="text" class="form-control" name="recovery_code" autocomplete="off" />
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center border-0">
                        <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection