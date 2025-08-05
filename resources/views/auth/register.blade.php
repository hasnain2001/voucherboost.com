@extends('layouts.welcome')
@section('title', 'Voucher Boost - Register')
@section('description', 'Create your Voucher Boost account to access exclusive deals, discounts, and coupons. Join our community to save money on your favorite products.')
@section('keywords', 'register, sign up, create account, deals, discounts, coupons, savings')

@push('styles')
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background-image: url('{{ asset('images/register.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .register-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .register-card {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 30px;
        animation: fadeIn 0.6s ease-out;
    }

    .card-header {
        background: transparent;
        border-bottom: none;
        padding-bottom: 20px;
    }

    .card-header h3 {
        color: #45046a;
        font-weight: 600;
        text-align: center;
        margin: 0;
        position: relative;
    }

    .card-header h3::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #45046a;
        margin: 10px auto 0;
        border-radius: 3px;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        transition: all 0.3s;
        padding-right: 40px; /* Space for eye icon */
    }

    .form-control:focus {
        border-color: #45046a;
        box-shadow: 0 0 0 0.25rem rgba(69, 4, 106, 0.25);
    }

    .input-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #6c757d;
        cursor: pointer;
        z-index: 5;
        padding: 0 8px;
    }

    .toggle-password:hover {
        color: #45046a;
    }

    .btn-purple {
        background-color: #45046a;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-purple:hover {
        background-color: #291634;
        transform: translateY(-2px);
    }

    .login-link {
        color: #45046a;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
    }

    .login-link:hover {
        text-decoration: underline;
        color: #291634;
    }

    /* Password strength meter styles */
    .password-strength {
        height: 5px;
        width: 100%;
        background: #eee;
        border-radius: 3px;
        margin-top: 5px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s ease, background 0.3s ease;
    }

    .strength-text {
        font-size: 13px;
        margin-top: 3px;
        text-align: right;
    }

    .poor {
        color: #dc3545;
    }

    .medium {
        color: #fd7e14;
    }

    .strong {
        color: #28a745;
    }

    /* Password requirements list */
    .password-requirements {
        font-size: 13px;
        color: #6c757d;
        margin-top: 5px;
    }

    .requirement {
        display: flex;
        align-items: center;
        margin-bottom: 3px;
    }

    .requirement i {
        margin-right: 5px;
        font-size: 12px;
    }

    .requirement.valid i {
        color: #28a745;
    }

    .requirement.invalid i {
        color: #dc3545;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
        .register-card {
            padding: 25px 15px;
        }
    }
</style>
@endpush

@section('main-content')
<div class="overlay"></div>

<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <h3>Create Account</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" placeholder="Create a password (min 8 characters)" oninput="checkPasswordStrength(this.value)">
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <!-- Password strength meter -->
                    <div class="password-strength">
                        <div class="password-strength-bar" id="password-strength-bar"></div>
                    </div>
                    <div class="strength-text" id="strength-text"></div>

                    <!-- Password requirements -->
                    <div class="password-requirements">
                        <div class="requirement invalid" id="length-req">
                            <i class="fas fa-circle"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement invalid" id="uppercase-req">
                            <i class="fas fa-circle"></i>
                            <span>At least 1 uppercase letter</span>
                        </div>
                        <div class="requirement invalid" id="number-req">
                            <i class="fas fa-circle"></i>
                            <span>At least 1 number</span>
                        </div>
                        <div class="requirement invalid" id="special-req">
                            <i class="fas fa-circle"></i>
                            <span>At least 1 special character</span>
                        </div>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirm your password">
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-purple">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="mb-0">Already have an account?
                        <a href="{{ route('login') }}" class="login-link">
                            Login here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.parentNode.querySelector('.toggle-password i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('strength-text');

        // Requirements elements
        const lengthReq = document.getElementById('length-req');
        const uppercaseReq = document.getElementById('uppercase-req');
        const numberReq = document.getElementById('number-req');
        const specialReq = document.getElementById('special-req');

        // Check requirements
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        // Update requirement indicators
        updateRequirement(lengthReq, hasLength);
        updateRequirement(uppercaseReq, hasUppercase);
        updateRequirement(numberReq, hasNumber);
        updateRequirement(specialReq, hasSpecial);

        // Calculate strength score (0-100)
        let strength = 0;
        if (password.length > 0) strength += Math.min(25, (password.length / 8) * 25);
        if (hasUppercase) strength += 25;
        if (hasNumber) strength += 25;
        if (hasSpecial) strength += 25;

        // Update strength meter and text
        strengthBar.style.width = strength + '%';

        if (strength === 0) {
            strengthBar.style.backgroundColor = '';
            strengthText.textContent = '';
        } else if (strength < 50) {
            strengthBar.style.backgroundColor = '#dc3545';
            strengthText.textContent = 'Poor';
            strengthText.className = 'strength-text poor';
        } else if (strength < 75) {
            strengthBar.style.backgroundColor = '#fd7e14';
            strengthText.textContent = 'Medium';
            strengthText.className = 'strength-text medium';
        } else {
            strengthBar.style.backgroundColor = '#28a745';
            strengthText.textContent = 'Strong';
            strengthText.className = 'strength-text strong';
        }
    }

    function updateRequirement(element, isValid) {
        if (isValid) {
            element.classList.remove('invalid');
            element.classList.add('valid');
        } else {
            element.classList.remove('valid');
            element.classList.add('invalid');
        }
    }
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
