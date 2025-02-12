<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
    body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background-image: url('{{ asset('images/register.png') }}');
    filter: blur(10px);
    -webkit-filter: blur(0);
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;


    }

        /* Dark overlay for better text visibility */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Card form styling */
        .card {
            position: relative;
            z-index: 1;
            background-color: rgba(150, 143, 143, 0.527);
            color: #f3f3f3;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        .form-container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }

        /* Custom button styling */
        .btn-primary {
            background-color: #0066cc;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Style for password toggle buttons */
        .toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .toggle-btn {
                top: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="form-container">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
                            <button type="button" class="toggle-btn" onclick="togglePassword('password')">Show</button>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                            <button type="button" class="toggle-btn" onclick="togglePassword('password_confirmation')">Show</button>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                    
                    

                    

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                          </div>
                          <br>
                        <!-- Already Registered -->
                            <div class="mb-3 col-6">
                                <a href="{{ route('login') }}" class=" btn btn-dark">Already registered?</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const button = input.nextElementSibling;

            if (input.type === "password") {
                input.type = "text";
                button.textContent = "Hide";
            } else {
                input.type = "password";
                button.textContent = "Show";
            }
        }
    </script>
</body>
</html>
