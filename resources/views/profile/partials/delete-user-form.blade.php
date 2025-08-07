<section class="mb-5">
    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <h2 class="h5 mb-0">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ __('Delete Account') }}
            </h2>
        </div>
        <div class="card-body">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-octagon-fill me-2"></i>{{ __('Warning') }}</h4>
                <p class="mb-0">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
            </div>

            <button class="btn btn-danger btn-lg w-100 py-2" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
                <i class="bi bi-trash-fill me-2"></i>{{ __('Delete Account') }}
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ __('Confirm Account Deletion') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-octagon-fill me-2"></i>
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Enter your password to confirm:') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="{{ __('Password') }}" required>
                            </div>
                            @if($errors->userDeletion->get('password'))
                                <div class="text-danger mt-2">
                                    @foreach ($errors->userDeletion->get('password') as $error)
                                        <small><i class="bi bi-x-circle-fill me-1"></i>{{ $error }}</small><br>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i>{{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill me-2"></i>{{ __('Permanently Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .modal-content {
        border-width: 2px;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
