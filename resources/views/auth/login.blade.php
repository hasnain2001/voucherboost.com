@extends('layouts.welcome')
@section('title', 'Voucher Boost - Login')
@section('description','Find the best deals, discounts, and coupons on Voucher Boost. Save money on your favorite products from top brands.')
@section('keywords','deals, discounts, coupons, savings, affiliate marketing, promo codes, cashback, online shopping, special offers, vouchers, best prices, holiday sales, seasonal discounts, gift cards, price comparison, money-saving tips')

@push('styles')
<style>
    body {
        background-image: url({{ asset('images/login.png') }});
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;

        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 20px;
        animation: fadeIn 0.6s ease-in-out;
    }

    .login-card {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
        transform: translateY(0);
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    .logo {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
        animation: bounceIn 0.8s;
    }

    .logo img {
        width: 120px;
        height: auto;
    }

    .heading {
        text-align: center;
        font-size: 28px;
        color: #45046a;
        margin-bottom: 30px;
        font-weight: 600;
        position: relative;
    }

    .heading::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #45046a;
        margin: 10px auto;
        border-radius: 3px;
    }

    .btn-purple {
        background-color: #45046a;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-purple:hover {
        background-color: #291634;
        transform: translateY(-2px);
    }

    .btn-outline-purple {
        border: 1px solid #45046a;
        color: #45046a;
        background: transparent;
    }

    .btn-outline-purple:hover {
        background-color: #45046a;
        color: white;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #45046a;
        box-shadow: 0 0 0 0.25rem rgba(69, 4, 106, 0.25);
    }

    .input-group-text {
        cursor: pointer;
        background-color: #f8f9fa;
        transition: all 0.3s;
    }

    .input-group-text:hover {
        background-color: #e9ecef;
    }

    .form-check-input:checked {
        background-color: #45046a;
        border-color: #45046a;
    }

    .forgot-link {
        color: #6c757d;
        transition: color 0.3s;
        text-decoration: none;
    }

    .forgot-link:hover {
        color: #45046a;
        text-decoration: underline;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.8); opacity: 0; }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .form-group {
        animation: slideIn 0.5s ease-out forwards;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }

    @media (max-width: 576px) {
        .login-card {
            padding: 30px 20px;
        }

        .heading {
            font-size: 24px;
        }
    }
</style>
@endpush

@section('main-content')
<!-- Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Session Status -->
@if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
@endif

<div class="login-container">
    <div class="login-card">
        <!-- Logo Section -->
        <div class="logo">
            <img src="{{asset('images/logo.png')}}" alt="Voucher Boost Logo">
        </div>
        <h1 class="heading">Welcome Back</h1>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email Address -->
            <div class="mb-4 form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4 form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    <button type="button" class="input-group-text" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4 form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div class="d-grid gap-2 mb-3 form-group">
                <button type="submit" class="btn btn-purple py-2">
                    {{ __('Login') }} <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-3 form-group">
                <p class="mb-0">Don't have an account?
                    <a href="{{route('register')}}" class="text-decoration-none" style="color: #45046a; font-weight: 500;">
                        {{ __('Register here') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript to toggle password visibility -->
<script>
    function togglePasswordVisibility() {
        const passwordField = document.getElementById('password');
        const toggleIcon = event.currentTarget.querySelector('i');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
