<x-app-layout>
 <div class="container-fluid p-0">
        <header class="bg-white shadow-sm py-3">
            <div class="container">
                <h2 class="h5 mb-0 text-dark">
                    {{ __('Profile') }}
                </h2>
            </div>
        </header>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="profile-section mb-4">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>

                        <div class="profile-section mb-4">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        <div class="profile-section">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</x-app-layout>

