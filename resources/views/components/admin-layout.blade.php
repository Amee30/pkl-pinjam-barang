<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
        
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('layouts.partials.header')
            
            <!-- Main Content with Scroll -->
            <main class="flex-1 overflow-y-auto bg-gray-100 dark:bg-gray-900">
                <!-- Content -->
                <div class="min-h-full">
                    {{ $slot }}
                </div>
                
                <!-- Footer - Full Width -->
                <x-footer />
            </main>
        </div>
    </div>
</body>
</html>