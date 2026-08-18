<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz Assessment') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">
        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
            Quiz & Assessment
        </a>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">
                Daftar Kuis
            </a>

            @auth
                <a href="{{ route('admin.quizzes.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                    Admin Panel
                </a>
                <div class="flex items-center gap-3 pl-3 border-l border-gray-200">
                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }} (Admin)</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium transition">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800 transition">
                    Login Admin
                </a>
            @endauth
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8 max-w-5xl">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>