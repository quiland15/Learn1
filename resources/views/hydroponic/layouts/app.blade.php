<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Hydroponic Monitoring System' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: 'oklch(0.965 0.02 155)',
                        foreground: 'oklch(0.25 0.04 155)',
                        card: 'rgba(255, 255, 255, 0.85)',
                        'card-foreground': 'oklch(0.25 0.04 155)',
                        primary: 'oklch(0.52 0.14 155)',
                        'primary-foreground': 'oklch(0.98 0 0)',
                        secondary: 'oklch(0.94 0.025 155)',
                        'secondary-foreground': 'oklch(0.35 0.06 155)',
                        muted: 'oklch(0.95 0.018 155)',
                        'muted-foreground': 'oklch(0.48 0.03 155)',
                        accent: 'oklch(0.58 0.16 155)',
                        'accent-foreground': 'oklch(0.98 0 0)',
                        destructive: 'oklch(0.577 0.245 27.325)',
                        border: 'oklch(0.88 0.03 155)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        'xl': '0.875rem',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: oklch(0.965 0.02 155);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen bg-background text-foreground antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>
