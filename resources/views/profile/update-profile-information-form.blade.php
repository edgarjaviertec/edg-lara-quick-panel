<div class="mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2 class="h4">Profile information</h2>
            <p>Update your account's profile information and email address.</p>
        </div>
        <div class="col-12 col-lg-8">
            <form method="POST" action="{{ route('user-profile-information.update') }}">
                @csrf
                @method('PUT')
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') ?? auth()->user()->name }}" required autofocus autocomplete="name" />
                        </div>
                        <div class="form-group mb-0">
                            <label>{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end border-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Profile') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


