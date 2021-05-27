<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="hero relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" style="background-image: url({{ asset('img/hero.jpg') }});">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-white underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-white underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-white underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="text-center hero-content text-neutral-content">
                <h1 class="mb-5 text-5xl font-bold">
                    Dercs Computer Repair Shop
                </h1>
            </div>
        </div>
    </body>
</html>
