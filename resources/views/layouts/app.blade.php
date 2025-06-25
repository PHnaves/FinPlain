<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FinPlan') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Favicons -->
        <link rel="app-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site-webmanifest') }}">
        <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
        
    </head>
    <body class="font-sans antialiased">
        <!-- Preloader Start -->
        <div class="preloader h-full fixed w-full z-[9999] bg-[#0A5B5E] transition duration-300">
            <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4" alt="Logo">
        </div>
        <!-- Preloader End -->

        <div class="min-h-screen">
            <div id="mainContent" class="opacity-0 transition-opacity duration-300">
                @include('layouts.navigation')

                <!-- Conteúdo Principal -->
                <div class="md:ml-72 min-h-screen">
                    <main class="p-4 md:p-6">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        {{-- finbot --}}
        <script
            src="https://bots.easy-peasy.ai/chat.min.js"
            data-chat-url="https://bots.easy-peasy.ai/bot/efb32a87-79f0-4547-b415-5b176ecd7bfe"
            data-btn-position="bottom-right"
            data-widget-btn-color="#11999e" 
            defer> 
        </script>

        <script>
            // Preloader
            window.addEventListener('load', function() {
                const preloader = document.querySelector('.preloader');
                const mainContent = document.getElementById('mainContent');
                
                setTimeout(function() {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                    mainContent.style.opacity = '1';
                }, 1000);
            });
        </script>

        @stack('scripts')
    </body>
</html>