@extends('layouts.default')

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
            <div class="card border shadow">
                <form method="POST" action="{{ url('/two-factor-challenge') }}">
                    @csrf
                    <div class="card-body">
                        <div id="authenticationCode">
                            <p>{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</p>
                            <div class="form-group">
                                <label>{{ __('Authentication code') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       autofocus
                                       autocomplete="off"/>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary toggle-code">{{__('Use a recovery code')}}</button>
                        </div>
                        <div id="recoveryCode" class="d-none">
                            <p>{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</p>
                            <div class="form-group">
                                <label>{{ __('Recovery code') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="recovery_code"
                                       autocomplete="off"/>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary toggle-code">{{__('Use an authentication code')}}</button>
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

@section('custom-scripts')
    <script>
        $('#recoveryCode button.toggle-code').click(function (e) {
            e.preventDefault();
            $('#authenticationCode').removeClass('d-none');
            $('#recoveryCode').addClass('d-none');
        });
        $('#authenticationCode button.toggle-code').click(function (e) {
            e.preventDefault();
            $('#recoveryCode').removeClass('d-none');
            $('#authenticationCode').addClass('d-none');
        });
    </script>
@endsection