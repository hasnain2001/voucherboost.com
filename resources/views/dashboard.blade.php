@extends('welcome')


    <style>
        .dropdown-item{
            margin: 12px;
        }
    </style>
    @section('main-content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold mb-0">{{ __('Dashboard') }}</h2>

            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('images/profile.png')}}" alt="Profile Picture" class="rounded-circle me-2"  style="width: 40px; height: 40px;">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                             <i class="bi bi-person-circle me-2"></i>
                            {{ __('View Profile') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                             <i class="bi bi-gear-fill me-2"></i>
                            {{ __('Settings') }}
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger d-flex align-items-center" type="submit">
                                 <i class="bi bi-box-arrow-right me-2"></i>
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>


        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">{{ __('Welcome back!') }}   <span>  {{ Auth::user()->name }}</span></h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="mb-0">{{ __('You\'re logged in!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection


