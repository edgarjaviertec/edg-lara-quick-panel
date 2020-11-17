<div class="mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2 class="h4">{{__('Two factor authentication')}}</h2>
            <p>{{__('Add additional security to your account using two factor authentication.')}}</p>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div id="twoFactorDisabled" class="{{ auth()->user()->two_factor_secret ? 'd-none' : '' }}">
                        <h3 class="h4">{{__('Two factor authentication disabled')}}</h3>
                        <p>{{__("When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.")}}.</p>
                        <button id="enableTwoFactorBtn"
                                type="button"
                                class="btn btn-primary">{{ __('Enable two-factor') }}</button>
                    </div>
                    <div id="twoFactorEnabled" class="{{ !auth()->user()->two_factor_secret ? 'd-none' : '' }}">
                        <h3 class="h4 mb-3">{{__('Two factor authentication enabled')}}</h3>
                        <button id="disableTwoFactorBtn"
                                type="button"
                                class="btn btn-danger mb-3"
                                data-toggle="feature"
                                @if(Laravel\Fortify\Features::optionEnabled(Laravel\Fortify\Features::twoFactorAuthentication(), 'confirmPassword') )
                                data-show="confirmation-modal"
                                @endif>
                            <span class="btn-content">{{ __('Disable two-factor') }}</span>
                            <span class="spinner d-none"><span
                                        class="spinner-border spinner-border-sm mr-2"></span><span>Loading...</span></span>
                        </button>
                        {{-- Show SVG QR Code, After Enabling 2FA --}}
                        <p>{{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}</p>
                        <div id="qrCodeSVG" class="mb-3"></div>
                        {{-- Show 2FA Recovery Codes --}}
                        <p>{{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}</p>
                        <div id="recoveryCodes" class="mb-3">
                            <ul class="recovery-codes">
                                @if(auth()->user()->two_factor_secret)
                                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                        <li>{{ $code }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        {{-- Regenerate 2FA Recovery Codes --}}
                        <button id="regenerateRecoveryCodesBtn"
                                type="button"
                                class="btn btn-primary">{{__('Regenerate recovery codes')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>