<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 flex flex-col">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900">
        @if(auth()->user()->role === 'customer')
            @include('layouts.navigation')
        @endif
        @if(auth()->user()->role === 'employee')
            @include('layouts.navigationEmployee')
        @endif
    </div>

    @isset($header)
        <header class="bg-white dark:bg-slate-800 shadow-md border-b border-blue-100 dark:border-blue-900">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <div class="text-gray-800 dark:text-gray-200">
                        {{ $header }}
                    </div>
                </div>
            </div>
        </header>
    @endisset

    <main class="py-6 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-blue-900 text-white py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} Bus Company. All rights reserved.</p>
        </div>
    </footer>
</div>
</body>
</html>
