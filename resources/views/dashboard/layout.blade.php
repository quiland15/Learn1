<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Start Green – Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/dashboard.jsx'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root { --spinach: #1E5631; --spinach-accent: #8E24AA; }
    </style>
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 font-sans antialiased">
    <div id="dashboard-root" data-initial="{{ e(json_encode($initial ?? [])) }}"></div>
</body>
</html>
