@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-primary w-100 h-screen p-3 p-md-0">
        <div class="w-100 mw-md">
            <div class="card border shadow">
                <form method="POST" action="{{ url('/two-factor-challenge') }}">
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
                        <div id="authenticationCode">
                            <p>{{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}</p>
                            <div class="form-group">
                                <label>{{ __('Code') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       autofocus
                                       autocomplete="off"/>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary toggle-code">Use a recovery code
                            </button>
                        </div>
                        <div id="recoveryCode" class="d-none">
                            <p>{{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}</p>
                            <div class="form-group">
                                <label>{{ __('Recovery Code') }}</label>
                                <input type="text"
                                       class="form-control"
                                       name="recovery_code"
                                       autocomplete="off"/>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary toggle-code">Use an authentication
                                code
                            </button>
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