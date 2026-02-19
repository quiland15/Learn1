<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Bank Sampah Induk Agape') }} – Ubah Sampah Jadi Rupiah</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>tailwind.config={theme:{extend:{fontFamily:{sans:['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif']}}}};</script>
    @endif
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white dark:bg-[#1a1625] text-[#1b1b18] dark:text-[#e8e4f0] font-sans antialiased">
    {{-- Nav - Putih & aksen hijau/ungu --}}
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-[#1a1625]/95 backdrop-blur border-b border-[#e5e7eb] dark:border-[#3d3652]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-14">
            <a href="/" class="font-semibold text-[#166534] dark:text-[#4ade80]">{{ config('app.name', 'Bank Sampah Agape') }}</a>
            @if (Route::has('login'))
                <nav class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm px-4 py-2 rounded-lg border border-[#e5e7eb] dark:border-[#3d3652] hover:bg-[#f3f4f6] dark:hover:bg-white/5">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm px-4 py-2 rounded-lg text-[#7c3aed] dark:text-[#a78bfa] hover:bg-[#f5f3ff] dark:hover:bg-white/5">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm px-4 py-2 rounded-lg bg-[#166534] dark:bg-[#22c55e] text-white hover:opacity-90">Daftar</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main>
        {{-- Hero - Putih, teks hijau & ungu --}}
        <section class="relative overflow-hidden bg-white dark:bg-[#1a1625]">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1b1b18] dark:text-white mb-4">
                        Bank Sampah Induk Agape
                    </h1>
                    <p class="text-xl lg:text-2xl text-[#166534] dark:text-[#4ade80] font-semibold mb-4">
                        Ubah Sampah Jadi Rupiah Bersama Agape
                    </p>
                    <p class="text-[#6b7280] dark:text-[#a1a1aa] text-base lg:text-lg mb-8">
                        Bergabunglah dengan 500+ keluarga yang sudah menjaga lingkungan sekaligus menghasilkan uang dari sampah.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="#daftar" class="inline-flex items-center justify-center px-6 py-3 rounded-lg font-medium bg-[#166534] dark:bg-[#22c55e] text-white hover:opacity-90 shadow-lg">
                            Jadi Nasabah Sekarang
                        </a>
                        <a href="#harga" class="inline-flex items-center justify-center px-6 py-3 rounded-lg font-medium border-2 border-[#7c3aed] dark:border-[#a78bfa] text-[#7c3aed] dark:text-[#a78bfa] hover:bg-[#f5f3ff] dark:hover:bg-white/5">
                            Lihat Harga Sampah
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Stats - Putih, angka hijau & ungu --}}
        <section class="border-y border-[#e5e7eb] dark:border-[#3d3652] bg-[#fafafa] dark:bg-[#221c33]">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
                    <div>
                        <p class="text-3xl lg:text-4xl font-bold text-[#166534] dark:text-[#4ade80]">500+</p>
                        <p class="text-sm font-medium text-[#6b7280] dark:text-[#a1a1aa] mt-1">Keluarga Bergabung</p>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl font-bold text-[#7c3aed] dark:text-[#a78bfa]">Resmi</p>
                        <p class="text-sm font-medium text-[#6b7280] dark:text-[#a1a1aa] mt-1">Mitra Pemerintah</p>
                    </div>
                    <div>
                        <p class="text-3xl lg:text-4xl font-bold text-[#166534] dark:text-[#4ade80]">50 Ton+</p>
                        <p class="text-sm font-medium text-[#6b7280] dark:text-[#a1a1aa] mt-1">Sampah Terkelola</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Cara Kerja - Kartu putih, nomor hijau & ungu bergantian --}}
        <section id="cara-kerja" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 bg-white dark:bg-[#1a1625]">
            <h2 class="text-2xl lg:text-3xl font-bold text-center text-[#1b1b18] dark:text-white mb-4">Cara Kerja</h2>
            <p class="text-center text-[#6b7280] dark:text-[#a1a1aa] text-lg mb-12">Semudah 1, 2, 3</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <div class="text-center p-6 rounded-2xl bg-white dark:bg-[#221c33] border border-[#e5e7eb] dark:border-[#3d3652] shadow-sm ring-1 ring-[#166534]/10 dark:ring-[#4ade80]/20">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#166534] dark:bg-[#22c55e] text-white font-bold text-xl mb-4">1</span>
                    <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-white mb-2">Pilah Sampah</h3>
                    <p class="text-sm text-[#6b7280] dark:text-[#a1a1aa]">Pisahkan sampah sesuai jenisnya: plastik, kaleng, dan kaca.</p>
                </div>
                <div class="text-center p-6 rounded-2xl bg-white dark:bg-[#221c33] border border-[#e5e7eb] dark:border-[#3d3652] shadow-sm ring-1 ring-[#7c3aed]/10 dark:ring-[#a78bfa]/20">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#7c3aed] dark:bg-[#8b5cf6] text-white font-bold text-xl mb-4">2</span>
                    <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-white mb-2">Jemput / Antar</h3>
                    <p class="text-sm text-[#6b7280] dark:text-[#a1a1aa]">Minta jemput atau antar langsung ke Bank Sampah Agape.</p>
                </div>
                <div class="text-center p-6 rounded-2xl bg-white dark:bg-[#221c33] border border-[#e5e7eb] dark:border-[#3d3652] shadow-sm ring-1 ring-[#166534]/10 dark:ring-[#4ade80]/20">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#166534] dark:bg-[#22c55e] text-white font-bold text-xl mb-4">3</span>
                    <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-white mb-2">Dapatkan Uang</h3>
                    <p class="text-sm text-[#6b7280] dark:text-[#a1a1aa]">Terima pembayaran langsung ke saldo tabungan Anda.</p>
                </div>
            </div>
        </section>

        {{-- Harga Terkini - Background ungu muda, kartu putih, aksen hijau & ungu --}}
        <section id="harga" class="bg-[#f5f3ff] dark:bg-[#2e2640] border-y border-[#e5e7eb] dark:border-[#3d3652] py-16 lg:py-24">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-center text-[#1b1b18] dark:text-white mb-4">Harga Terkini</h2>
                <p class="text-center text-[#6b7280] dark:text-[#a1a1aa] text-lg mb-12">Harga Sampah Hari Ini</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @php
                        $items = [
                            ['name' => 'Botol PET Bersih', 'price' => '3.500', 'badge' => 'High Value', 'accent' => 'green'],
                            ['name' => 'Ember Plastik', 'price' => '2.000', 'badge' => null, 'accent' => 'purple'],
                            ['name' => 'Pipa PVC', 'price' => '1.800', 'badge' => 'High Value', 'accent' => 'purple'],
                            ['name' => 'Plastik HDPE', 'price' => '2.500', 'badge' => 'High Value', 'accent' => 'green'],
                            ['name' => 'Gelas Plastik PP', 'price' => '1.500', 'badge' => null, 'accent' => 'green'],
                            ['name' => 'Kaleng Aluminium', 'price' => '12.000', 'badge' => 'High Value', 'accent' => 'purple'],
                            ['name' => 'Kaleng Baja', 'price' => '3.000', 'badge' => null, 'accent' => 'green'],
                            ['name' => 'Kaleng Aerosol', 'price' => '2.500', 'badge' => null, 'accent' => 'purple'],
                        ];
                    @endphp
                    @foreach ($items as $item)
                        <div class="p-4 rounded-xl bg-white dark:bg-[#221c33] border border-[#e5e7eb] dark:border-[#3d3652] shadow-sm">
                            @if ($item['badge'])
                                <span class="text-xs font-medium {{ $item['accent'] === 'green' ? 'text-[#166534] dark:text-[#4ade80]' : 'text-[#7c3aed] dark:text-[#a78bfa]' }}">{{ $item['badge'] }}</span>
                            @endif
                            <h3 class="font-semibold text-[#1b1b18] dark:text-white mt-1">{{ $item['name'] }}</h3>
                            <p class="{{ $item['accent'] === 'green' ? 'text-[#166534] dark:text-[#4ade80]' : 'text-[#7c3aed] dark:text-[#a78bfa]' }} font-bold mt-1">Rp {{ $item['price'] }} / kg</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Tentang Kami - Putih, judul hijau & ungu, quote border ungu --}}
        <section id="tentang" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 bg-white dark:bg-[#1a1625]">
            <h2 class="text-2xl lg:text-3xl font-bold text-center text-[#1b1b18] dark:text-white mb-4">Tentang Kami</h2>
            <p class="text-center text-xl font-semibold text-[#166534] dark:text-[#4ade80] mb-8">Bank Sampah Induk Agape</p>
            <p class="text-center text-[#6b7280] dark:text-[#a1a1aa] max-w-3xl mx-auto mb-4">
                Didirikan pada tahun 2018, Bank Sampah Induk Agape lahir dari keprihatinan terhadap krisis sampah di kota kami. Kami percaya bahwa setiap sampah memiliki nilai.
            </p>
            <p class="text-center text-[#6b7280] dark:text-[#a1a1aa] max-w-3xl mx-auto mb-12">
                Dengan lebih dari 500 keluarga terdaftar, kami telah berhasil mengelola lebih dari 50 ton sampah dan bekerja sama dengan pemerintah kota dan berbagai mitra.
            </p>
            <p class="text-sm font-medium text-[#7c3aed] dark:text-[#a78bfa] text-center mb-6">Mitra Kami</p>
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <span class="px-4 py-2 rounded-lg bg-[#f5f3ff] dark:bg-[#221c33] border border-[#7c3aed]/20 dark:border-[#a78bfa]/30 text-[#7c3aed] dark:text-[#a78bfa]">Green Indo</span>
                <span class="px-4 py-2 rounded-lg bg-[#f0fdf4] dark:bg-[#14532d]/30 border border-[#166534]/20 dark:border-[#4ade80]/30 text-[#166534] dark:text-[#4ade80]">EcoCycle</span>
                <span class="px-4 py-2 rounded-lg bg-[#f5f3ff] dark:bg-[#221c33] border border-[#7c3aed]/20 dark:border-[#a78bfa]/30 text-[#7c3aed] dark:text-[#a78bfa]">Pemerintah Kota</span>
                <span class="px-4 py-2 rounded-lg bg-[#f0fdf4] dark:bg-[#14532d]/30 border border-[#166534]/20 dark:border-[#4ade80]/30 text-[#166534] dark:text-[#4ade80]">Sustainable Future</span>
            </div>
            <blockquote class="max-w-2xl mx-auto text-center border-l-4 border-[#7c3aed] dark:border-[#a78bfa] pl-6 py-2 my-8">
                <p class="text-[#1b1b18] dark:text-white italic">"Keberlanjutan bukan hanya tentang lingkungan, tapi tentang masa depan anak-anak kita."</p>
                <footer class="mt-2 text-sm font-semibold text-[#7c3aed] dark:text-[#a78bfa]">Budi Santoso</footer>
                <p class="text-xs text-[#6b7280] dark:text-[#a1a1aa]">Pendiri & Direktur, 2018</p>
            </blockquote>
        </section>

        {{-- CTA Final - Gradient hijau & ungu --}}
        <section id="daftar" class="bg-gradient-to-r from-[#166534] via-[#15803d] to-[#7c3aed] dark:from-[#14532d] dark:via-[#166534] dark:to-[#5b21b6] text-white py-16 lg:py-24">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl lg:text-3xl font-bold mb-4">Siap Menjaga Bumi?</h2>
                <p class="text-white/90 mb-8">Bergabunglah dengan komunitas Agape hari ini dan mulai ubah sampah menjadi nilai.</p>
                <a href="{{ Route::has('register') ? route('register') : '#' }}" class="inline-flex items-center justify-center px-8 py-4 rounded-lg font-medium bg-white text-[#7c3aed] hover:bg-white/90 shadow-lg">
                    Jadi Nasabah Sekarang
                </a>
            </div>
        </section>
    </main>

    <footer class="border-t border-[#e5e7eb] dark:border-[#3d3652] bg-white dark:bg-[#1a1625] py-6">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-[#6b7280] dark:text-[#a1a1aa]">
            &copy; {{ date('Y') }} {{ config('app.name', 'Bank Sampah Induk Agape') }}. Ubah Sampah Jadi Rupiah.
        </div>
    </footer>
</body>
</html>
