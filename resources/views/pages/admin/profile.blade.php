@extends('layouts.dashboard')

@section('title', 'Profile information')

@section('content')
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
        @include('includes.profile.update-profile-information-form')
    @endif
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        @include('includes.profile.update-password-form')
    @endif
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        @include('includes.profile.two-factor-authentication-form')
    @endif
    @include('includes.profile.logout-other-sessions-form')
@endsection

@section('modals')
    @include('includes.common.confirmation-modal')
@endsection

@section('custom-scripts')
    <script>
        loadProgressBar();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profilePhotoPreview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function clearAllErrors(elements) {
            if (elements.length > 0) {
                [].forEach.call(elements, function (err) {
                    err.classList.remove('is-invalid');
                    err.nextElementSibling.textContent = '';
                });
            }
        }

        function showError(element, errorMessage) {
            element.classList.add('is-invalid');
            element.nextElementSibling.textContent = errorMessage;
        }

        document.getElementById('updateProfileInformationBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            var form = document.getElementById("updateProfileInformationForm");
            var formData = new FormData(form);
            formData.append('_method', 'PUT');
            try {
                this.disabled = true;
                await axios.post("{{route('user-profile-information.update')}}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                var response = await axios.get("{{route('current-user-photo.show')}}");
                var profilePhotoURL = response.data.profile_photo_url;
                document.getElementById('deletePhotoBtn').classList.remove('d-none');
                document.getElementById('profilePhoto').setAttribute('src', profilePhotoURL);
                document.getElementById('profilePhotoPreview').setAttribute('src', profilePhotoURL);
                clearAllErrors(form.querySelectorAll('input.is-invalid'));
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
                if (error.response.status === 403) {
                    console.error(error.response.data.message);
                    location.reload();
                    return;
                }
                clearAllErrors(form.querySelectorAll('input.is-invalid'));
                if (error.response.data.errors.photo !== undefined) {
                    showError(form.querySelector('input[name="photo"]'), error.response.data.errors.photo[0]);
                }
                if (error.response.data.errors.email !== undefined) {
                    showError(form.querySelector('input[name="email"]'), error.response.data.errors.email[0]);
                }
                if (error.response.data.errors.name !== undefined) {
                    showError(form.querySelector('input[name="name"]'), error.response.data.errors.name[0]);
                }
            }
        });

        document.getElementById('selectNewPhotoBtn').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('fileUploadInput').click();
        });

        document.getElementById('deletePhotoBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            try {
                this.disabled = true;
                await axios.delete("{{route('current-user-photo.destroy')}}");
                var response = await axios.get("{{route('current-user-photo.show')}}");
                var profilePhotoURL = response.data.profile_photo_url;
                document.getElementById('deletePhotoBtn').classList.add('d-none');
                document.getElementById('profilePhoto').setAttribute('src', profilePhotoURL);
                document.getElementById('profilePhotoPreview').setAttribute('src', profilePhotoURL);
                document.getElementById('fileUploadInput').value = null;
                this.disabled = false;
            } catch (error) {
                console.error(error);
                this.disabled = false;
            }
        });

        document.getElementById('fileUploadInput').addEventListener('change', function () {
            readURL(this);
        });

        // Código para la actualización de la contraseña

        document.getElementById('updatePasswordBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            var form = document.getElementById("updatePasswordForm");
            var formData = new FormData(form);
            formData.append('_method', 'PUT');
            try {
                this.disabled = true;
                await axios.post("{{route('user-password.update') }}", formData);
                clearAllErrors(form.querySelectorAll('input.is-invalid'));
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
                clearAllErrors(form.querySelectorAll('input.is-invalid'));
                if (error.response.data.errors.current_password !== undefined) {
                    showError(form.querySelector('input[name="current_password"]'), error.response.data.errors.current_password[0]);
                }
                if (error.response.data.errors.password !== undefined) {
                    showError(form.querySelector('input[name="password"]'), error.response.data.errors.password[0]);
                }
                if (error.response.data.errors.password_confirmation !== undefined) {
                    showError(form.querySelector('input[name="password_confirmation"]'), error.response.data.errors.password_confirmation[0]);
                }
            }
        });

        // Código de la autenticación de dos factores

        document.getElementById('enableTwoFactorBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            try {
                this.disabled = true;
                await axios.post("/user/two-factor-authentication");
                await Promise.all([
                    showQrCode(),
                    showRecoveryCodes()
                ]);
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
            }
        });

        document.getElementById('regenerateRecoveryCodesBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            try {
                this.disabled = true;
                await axios.post('/user/two-factor-recovery-codes');
                showRecoveryCodes();
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
            }
        });

        document.getElementById('disableTwoFactorBtn').addEventListener('click', async function (e) {
            e.preventDefault();
            try {
                this.disabled = true;
                await axios.delete("/user/two-factor-authentication");
                document.getElementById('twoFactorEnabled').classList.add('d-none');
                document.getElementById('twoFactorDisabled').classList.remove('d-none');
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
            }

        });

        function showQrCode() {
            return axios.get('/user/two-factor-qr-code')
                .then(response => {
                    $('#twoFactorEnabled').removeClass('d-none');
                    $('#twoFactorDisabled').addClass('d-none');
                    $('#qrCodeSVG').html(response.data.svg);
                }).catch(function (error) {
                    console.log(error);
                });
        }

        function showRecoveryCodes() {
            return axios.get('/user/two-factor-recovery-codes')
                .then(response => {
                    var recoveryCodes = [];
                    var html = '';
                    recoveryCodes = response.data;
                    if (response.data.length > 0) {
                        recoveryCodes.forEach(function (code) {
                            html = html + `<li>${code}</li>`;
                        });
                    }
                    $('#recoveryCodes').find('ul').html(html);
                }).catch(function (error) {
                    console.log(error);
                });
        }

        // Código para cerrar las otras sesiones del usuario

        document.getElementById('logoutOtherSessionsBtn').addEventListener('click', function (e) {
            e.preventDefault();
            $('#confirmationModal').modal('show');
        });

        $('#confirmationModal').on('show.bs.modal', function () {
            var passwordInput = $(this)[0].querySelector('input[type="password"]');
            passwordInput.value = '';
            setTimeout(() => {
                passwordInput.focus();
            }, 250)
        })

        document.querySelector('#confirmationModal .submit-btn').addEventListener('click', async function (e) {
            e.preventDefault();
            var $modal = $('#confirmationModal');
            var passwordInput = $modal[0].querySelector('input[type="password"]');
            try {
                this.disabled = true;
                await axios.delete("{{ route('other-browser-sessions.destroy' )}}", {
                    data: {
                        'password': passwordInput.value.trim()
                    }
                });
                passwordInput.value = '';
                passwordInput.classList.remove('is-invalid');
                $modal.modal('hide');
                document.getElementById('logoutOtherSessionsBtn').dispatchEvent(new Event('confirmed'));
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.error(error);
                if (error.response.data.errors.password !== undefined) {
                    passwordInput.classList.add('is-invalid');
                    passwordInput.nextElementSibling.textContent = error.response.data.errors.password[0];
                }
            }
        });

        document.getElementById('logoutOtherSessionsBtn').addEventListener('confirmed', async function (e) {
            e.preventDefault();
            try {
                this.disabled = true;
                var response = await axios.get("{{route('other-browser-sessions.index')}}");
                var sessions = response.data;
                var html = '';
                var desktopIcon = `
                <svg viewBox="0 0 576 512">
                    <path fill="currentColor" d="M528 0H48C21.5 0 0 21.5 0 48v320c0 26.5 21.5 48 48 48h192l-16 48h-72c-13.3 0-24 10.7-24 24s10.7 24 24 24h272c13.3 0 24-10.7 24-24s-10.7-24-24-24h-72l-16-48h192c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zm-16 352H64V64h448v288z"></path>
                </svg>
                `;
                var mobileIcon = `
                <svg viewBox="0 0 320 512">
                    <path fill="currentColor" d="M272 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h224c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48zM160 480c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm112-108c0 6.6-5.4 12-12 12H60c-6.6 0-12-5.4-12-12V60c0-6.6 5.4-12 12-12h200c6.6 0 12 5.4 12 12v312z"></path>
                </svg>
                `;
                [].forEach.call(sessions, function (session) {
                    html = html + `
                    <li>
                        <span class="session-icon">${session.agent.is_desktop ? desktopIcon : mobileIcon}</span>
                        <span class="session-info">
                            <span>${session.agent.platform} - ${session.agent.browser}</span>
                            <small>${session.ip_address}</small>
                        </span>
                    </li>
                    `;
                });
                document.getElementById('sessionList').innerHTML = html;
                this.disabled = false;
            } catch (error) {
                this.disabled = false;
                console.log(error);
            }
        }, false);

    </script>
@endsection