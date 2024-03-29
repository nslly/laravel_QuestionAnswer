<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    </head>
    <body class="font-sans text-gray-900 dark:bg-gray-900 antialiased">
        <div class=" sm:pt-0 bg-gray-900 dark:bg-gray-900" id="app">
            {{ $slot }}
        </div>
    </body>
    
    <!-- Scripts -->
    <script>
        window.Auth = {!! json_encode([
            'signedIn' => Auth::check(),
            'user'     => Auth::user()
        ]) !!}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</html>

