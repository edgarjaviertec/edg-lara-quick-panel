<header class="navbar navbar-expand navbar-light bg-white shadow">
    <a class="navbar-brand" href="{{ route('dashboard.home') }}">
        <i class="fas fa-file-invoice-dollar brand"></i>
        <span class="brand-text">Laravel</span>
    </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown">
                <span>
					{{ \Illuminate\Support\Str::limit(auth()->user()->email, 15, $end='...') }}
				</span>
                <div class="small-profile-photo rounded-circle">
                    <img id="profilePhoto" src="{{ auth()->user()->profile_photo_url  }}" alt="">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('dashboard.profile') }}">{{__('Profile')}}</a>
                <form class="" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">{{ __('Logout') }}</button>
                </form>
            </div>
        </li>
    </ul>
</header>