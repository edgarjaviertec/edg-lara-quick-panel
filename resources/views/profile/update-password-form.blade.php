<div class="mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2 class="h4">Profile information</h2>
            <p>Update your account's profile information and email address.</p>
        </div>
        <div class="col-12 col-lg-8">
            <form method="POST" action="{{ route('user-password.update') }}">
                @csrf
                @method('PUT')
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" class="form-control" name="current_password" required autocomplete="current-password" />
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password" />
                        </div>
                        <div class="form-group mb-0">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end border-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>