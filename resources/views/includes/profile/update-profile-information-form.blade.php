<div class="mb-5">
    <div class="row">
        <div class="col-12 col-lg-4">
            <h2 class="h4">{{__('Profile information')}}</h2>
            <p>{{__("Update your account's profile information and email address.")}}</p>
        </div>
        <div class="col-12 col-lg-8">
            <form id="updateProfileInformationForm" method="POST"
                  action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-photo rounded-circle">
                                <img id="profilePhotoPreview" src="{{ auth()->user()->profile_photo_url  }}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" id="selectNewPhotoBtn"
                                    class="btn btn-sm btn-secondary">{{__('Select a new photo')}}</button>
                            <button type="button" id="deletePhotoBtn"
                                    class="btn btn-sm btn-secondary {{!auth()->user()->profile_photo_path ? 'd-none' : null}}">{{__('Remove photo')}}</button>
                            <input type="file" name="photo" id="fileUploadInput" class="d-none">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   autocomplete="off"
                            />
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group mb-0">
                            <label>{{ __('Email') }}</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ auth()->user()->email }}"
                                   autocomplete="off"
                            />
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end border-0">
                        <button id="updateProfileInformationBtn" type="submit" class="btn btn-primary">
                            {{ __('Update profile') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>