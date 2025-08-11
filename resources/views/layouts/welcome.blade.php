<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') | {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="author" content="Ozair Bin mazhar">
        <meta name="robots" content="index, follow">
        <meta name="google-site-verification" content="G9G5V1QAftbFt5kLOpPfck8E9QHDpZUvpqZ5udgmXmU" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/icons/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="{{asset('cssfiles/store-detail.css')}}">
        <link rel="stylesheet" href="{{asset('cssfiles/footer.css')}}">
        <link rel="stylesheet" href="{{ asset('cssfiles/nabar.css') }}">
        <link rel="stylesheet" href="{{ asset('cssfiles/style.css') }}">
        @stack('styles')

    </head>
    <body >
        <x-navbar/>
            <main class="">
                @yield('main-content')
            </main>
        <x-footer/>


        <!-- JavaScript -->
        @stack('scripts')
        <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
          </body>
</html>
