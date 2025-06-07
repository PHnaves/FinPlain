<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FinPlain') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

        <!-- Conteúdo Principal -->
        <div class="md:ml-72 md:mt-16 mt-16 min-h-screen bg-gray-50">
            <main class="p-4 md:p-6">
                {{ $slot }}
            </main>
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

        @stack('scripts')
    </body>
</html>
