<div class="mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2 class="h4">{{__('Browser sessions')}}</h2>
            <p>{{__('Manage and logout your active sessions on other browsers and devices.')}}</p>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <p>{{__("If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.")}}</p>
                    @if(count($sessions) > 0)
                        <ul id="sessionList" class="sesion-list">
                            @foreach ($sessions as $session)
                                <li>
                                    <span class="session-icon">
                                        @if( $session->agent['is_desktop'] )
                                            <svg viewBox="0 0 576 512">
                                                <path fill="currentColor"
                                                      d="M528 0H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h192l-16 48h-72c-13.3 0-24 10.7-24 24s10.7 24 24 24h272c13.3 0 24-10.7 24-24s-10.7-24-24-24h-72l-16-48h192c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zm-16 352H64V64h448v288z"></path>
                                            </svg>
                                        @else
                                            <svg viewBox="0 0 320 512">
                                                <path fill="currentColor"
                                                      d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z"></path>
                                            </svg>
                                        @endif
                                    </span>
                                    <span class="session-info">
                                        <span>{{ $session->agent['platform']}} - {{ $session->agent['browser'] }}</span>
                                        <small>{{ $session->ip_address }}</small>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <button id="logoutOtherSessionsBtn"
                            type="button"
                            class="btn btn-primary">{{ __('Logout other browser sessions') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>


