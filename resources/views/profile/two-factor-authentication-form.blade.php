@if(! auth()->user()->two_factor_secret)
    {{-- Enable 2FA --}}
    <div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <h2 class="h4">Two factor authentication</h2>
                <p>Add additional security to your account using two factor authentication.</p>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h3 class="h4">You have not enabled two factor authentication </h2>
                        <p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You m ay retrieve this token from your phone's Google Authenticator application.</p>
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                            {{ __('Enable Two-Factor') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Disable 2FA --}}
    <div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <h2 class="h4">Two factor authentication</h2>
                <p>Add additional security to your account using two factor authentication.</p>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-body">
                    <h3 class="h4 mb-3">You have enabled two factor authentication </h2>
                        <p>When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You m ay retrieve this token from your phone's Google Authenticator application.</p>
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3">
                                {{ __('Disable Two-Factor') }}
                            </button>
                        </form>
                        @if(session('status') == 'two-factor-authentication-enabled')
                            {{-- Show SVG QR Code, After Enabling 2FA --}}
                            <p>{{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}</p>
                            <div class="mb-3">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        @endif
                        {{-- Show 2FA Recovery Codes --}}
                        <p>{{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}</p>
                        <div class="mb-3">
                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                <div>{{ $code }}</div>
                            @endforeach
                        </div>
                        {{-- Regenerate 2FA Recovery Codes --}}
                        <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">{{ __('Regenerate Recovery Codes') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
