<section class="mb-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h2 class="h5 mb-0 text-dark">
                <i class="bi bi-person-badge me-2"></i>{{ __('Profile Information') }}
            </h2>
            <p class="text-muted mt-2 mb-0 small">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>

        <div class="card-body">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold">
                        <i class="bi bi-person-fill me-1"></i>{{ __('Full Name') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text"
                               class="form-control"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               autofocus
                               autocomplete="name">
                    </div>
                    @if($errors->get('name'))
                        <div class="text-danger mt-2 small">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                            @foreach ($errors->get('name') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label fw-semibold">
                        <i class="bi bi-envelope-fill me-1"></i>{{ __('Email Address') }}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-at"></i></span>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required
                               autocomplete="username">
                    </div>
                    @if($errors->get('email'))
                        <div class="text-danger mt-2 small">
                            <i class="bi bi-exclamation-circle-fill me-1"></i>
                            @foreach ($errors->get('email') as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning mt-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div>
                                    <p class="mb-1">{{ __('Your email address is unverified.') }}</p>
                                    <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                                        <i class="bi bi-send-fill me-1"></i>{{ __('Click to resend verification email') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    @endif
                </div>

                <div class="d-flex align-items-center gap-3 mt-4">
                    <button type="submit" class="btn btn-dark px-4 py-2">
                        <i class="bi bi-save-fill me-2"></i>{{ __('Save Changes') }}
                    </button>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-0" id="profile-update-message">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ __('Profile updated successfully!') }}
                            <script>
                                setTimeout(() => {
                                    document.getElementById('profile-update-message').style.opacity = '0';
                                    setTimeout(() => {
                                        document.getElementById('profile-update-message').style.display = 'none';
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

<style>
    .card {
        border-radius: 0.5rem;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    #profile-update-message {
        transition: opacity 0.5s ease;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
</style>
