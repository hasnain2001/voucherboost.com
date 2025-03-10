<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/icons/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('cssfiles/nabar.css') }}">
        <link rel="stylesheet" href="{{ asset('cssfiles/style.css') }}">
        <link rel="stylesheet" href="{{asset('cssfiles/store-detail.css')}}">
        <link rel="stylesheet" href="{{asset('cssfiles/footer.css')}}">


        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                color: #333;
            }
            .error-container {
                text-align: center;
                padding: 2rem;
                border-radius: 0.5rem;
                background: rgba(255, 255, 255, 0.8);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .error-code {
                font-size: 3rem;
                font-weight: bold;
                color: #e3342f;
            }
            .error-message {
                font-size: 1.5rem;
                margin-top: 1rem;
                color: #555;
            }
        </style>
    </head>
    <body class="">
<x-navbar>
</x-navbar>

        <main class="d-flex align-items-center justify-content-center min-vh-100">
            <div class="error-container">
                <div class="error-code">
                    @yield('code')
                </div>
                <div class="error-message">
                    @yield('message')
                </div>
            </div>
        </main>

<x-footer></x-footer>

        <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </body>
</html>
