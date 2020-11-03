@extends('layouts.dashboard')

@section('title', 'Profile information')

@section('content')
    @if(session('status') == 'profile-information-updated')
        <div class="alert alert-success mb-5">Profile information updated</div>
    @endif

    @if(session('status') == 'password-updated')
        <div class="alert alert-success mb-5">Password updated</div>
    @endif

    @if(session('status') == 'two-factor-authentication-enabled')
        <div class="alert alert-success mb-5">Two factor authentication enabled</div>
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
        @include('profile.update-profile-information-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        @include('profile.update-password-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('profile.two-factor-authentication-form')
    @endif
@endsection

@section('modals')
    <x-confirmation-modal/>
@endsection

@section('custom-scripts')
    <script>
        var axiosConfig = {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }

        $('.open-confirmation-modal').click(async function (e) {
            e.preventDefault();
            var confirmPassword = $(e.target).attr('data-confirm-password');
            if (confirmPassword === 'false') {
                $(this).closest('form').submit()
                return false;
            }
            try {
                $(this).prop("disabled", true);
                $(this).find('.btn-content').addClass('d-none');
                $(this).find('.spinner').removeClass('d-none');
                const response = await checkConfirmation();
                $(this).prop("disabled", false);
                $(this).find('.btn-content').removeClass('d-none');
                $(this).find('.spinner').addClass('d-none');
                if (response.data.confirmed) {
                    $(this).closest('form').submit();
                    return false;
                }
                $('#confirmationModal').modal('show', $(this));
            } catch (error) {
                $(this).prop("disabled", false);
                $(this).find('.btn-content').removeClass('d-none');
                $(this).find('.spinner').addClass('d-none');
                console.log(error);
            }
        });

        $('#confirmationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var form = button.attr('data-form-to-submit');
            var modal = $(this);
            modal.find('.submit-btn').attr('data-form-to-submit', form)
            modal.find('input[type="password"]').val('');
            setTimeout(() => {
                modal.find('input[type="password"]').focus();
            }, 250)
        })

        $('#confirmationModal .submit-btn').on('click', async function (e) {
            e.preventDefault();
            try {
                $(this).prop("disabled", true);
                $(this).find('.btn-content').addClass('d-none');
                $(this).find('.spinner').removeClass('d-none');
                await confirmPassword($('#confirmationModal').find('input[type="password"]').val().trim());
                $(this).prop("disabled", false);
                $(this).find('.btn-content').removeClass('d-none');
                $(this).find('.spinner').addClass('d-none');
                $('#confirmationModal').find('input[type="password"]').val('');
                $('#confirmationModal').find('input[type="password"]').removeClass('is-invalid');
                $('#confirmationModal').modal('hide');
                $($(this).attr('data-form-to-submit')).submit();
            } catch (error) {
                $(this).prop("disabled", false);
                $(this).find('.btn-content').removeClass('d-none');
                $(this).find('.spinner').addClass('d-none');
                $('#confirmationModal').find('input[type="password"]').addClass('is-invalid');
                $('#confirmationModal').find('input[type="password"]').next('.invalid-feedback').text(error.response.data.errors.password[0])
            }
        });

        function checkConfirmation() {
            return axios.get("{{ route('password.confirmation') }}");
        }

        function confirmPassword(password) {
            return axios.post(
                "{{ route('password.confirm') }}",
                {
                    password: password
                },
                axiosConfig
            );
        }
    </script>
@endsection