<section class="mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h2 class="h5 mb-0 text-dark">
                <i class="bi bi-shield-lock me-2"></i>{{ __('Update Password') }}
            </h2>
        </div>
        <div class="card-body">
            <div class="alert alert-secondary mb-4">
                <i class="bi bi-info-circle-fill me-2"></i>
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-4">
                    <label for="update_password_current_password" class="form-label fw-semibold">
                        <i class="bi bi-key-fill me-1"></i>{{ __('Current Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password"
                               class="form-control"
                               id="update_password_current_password"
                               name="current_password"
                               autocomplete="current-password">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    @if($errors->updatePassword->get('current_password'))
                        <div class="text-danger mt-2 small">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                            @foreach ($errors->updatePassword->get('current_password') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="update_password_password" class="form-label fw-semibold">
                        <i class="bi bi-key me-1"></i>{{ __('New Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password"
                               class="form-control"
                               id="update_password_password"
                               name="password"
                               autocomplete="new-password">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    @if($errors->updatePassword->get('password'))
                        <div class="text-danger mt-2 small">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                            @foreach ($errors->updatePassword->get('password') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="form-text mt-1 small">
                        <i class="bi bi-lightbulb-fill me-1"></i>
                        {{ __('Use at least 8 characters with a mix of letters, numbers, and symbols.') }}
                    </div>
                </div>

                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label fw-semibold">
                        <i class="bi bi-key-fill me-1"></i>{{ __('Confirm Password') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password"
                               class="form-control"
                               id="update_password_password_confirmation"
                               name="password_confirmation"
                               autocomplete="new-password">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    @if($errors->updatePassword->get('password_confirmation'))
                        <div class="text-danger mt-2 small">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                            @foreach ($errors->updatePassword->get('password_confirmation') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-3 mt-4">
                    <button type="submit" class="btn btn-dark px-4 py-2">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ __('Save Changes') }}
                    </button>

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-0" id="password-update-message">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ __('Password updated successfully!') }}
                            <script>
                                setTimeout(() => {
                                    document.getElementById('password-update-message').style.opacity = '0';
                                    setTimeout(() => {
                                        document.getElementById('password-update-message').style.display = 'none';
                                    }, 500);
                                }, 2000);
                            </script>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        });
    });
</script>

<style>
    .card {
        border-radius: 0.5rem;
        border: none;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .toggle-password {
        transition: all 0.3s ease;
    }
    #password-update-message {
        transition: opacity 0.5s ease;
    }
</style>
