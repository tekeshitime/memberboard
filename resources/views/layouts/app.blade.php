<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- 音声再生用のjs -->
    <script src="{{ asset('js/audio.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        @if(Route::currentRouteName() == 'tracks.index')
            <!-- indexメソッドに関連する要素を表示 -->
            <div class="bg-black">
                <div class="max-w-6xl mx-auto search py-20 px-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-bold text-2xl text-white">お気に入りのトラックを見つけよう</h2>
                    <input type="text" placeholder="Explore new sounds">
                    <button type="submit" class="text-white bg-gray-500 rounded font-medium px-4 py-2 text-white">Search</button>
                </div>
            </div>
        @endif
        <main>
            {{ $slot }}
        </main>
        <footer>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-20">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        {{-- <a href="{{ route('') }}"> --}}
                            © 2024 PULSE GARDEN. All Rights Reserved
                        {{-- </a> --}}
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Terms & Use') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Policy') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('other') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>