<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Start Green') – Bank Sampah Induk Agape</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root { --spinach: #1E5631; --spinach-accent: #8E24AA; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex flex-col font-sans antialiased">
    <header class="border-b border-gray-200 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-14">
            <a href="{{ url('/') }}" class="font-semibold text-[#1E5631]">Start Green – Agape</a>
            <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-[#1E5631]">← Kembali</a>
        </div>
    </header>
    <main class="flex-1 flex items-center justify-center p-6">
        @yield('content')
    </main>
    <footer class="py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Start Green – Bank Sampah Induk Agape
    </footer>
</body>
</html>
