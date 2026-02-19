<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Start Green – Bank Sampah Induk Agape</title>
    <meta name="description" content="Ubah Sampah Jadi Rupiah. Sistem manajemen sampah profesional oleh Bank Sampah Induk Agape.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        :root { --spinach: #1E5631; --spinach-accent: #8E24AA; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white text-gray-900 font-sans antialiased">
    {{-- Nav: Spinach theme, only Login/Register --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-2 font-semibold text-[#1E5631]">
                <span class="text-xl">Start Green</span>
                <span class="text-gray-500 text-sm font-normal">– Agape</span>
            </a>
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm px-4 py-2 rounded-lg bg-[#1E5631] text-white hover:bg-[#164a28]">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm px-4 py-2 rounded-lg text-[#8E24AA] hover:bg-[#8E24AA]/5 font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm px-4 py-2 rounded-lg bg-[#8E24AA] text-white hover:bg-[#7b1fa2] font-medium">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section class="relative overflow-hidden">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-[#1E5631] mb-4">
                        Start Green
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-700 font-medium mb-2">Bank Sampah Induk Agape</p>
                    <p class="text-lg text-gray-600 mb-8">
                        Ubah sampah jadi rupiah. Daur ulang yang terkelola, lingkungan yang terjaga.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-semibold bg-[#8E24AA] text-white hover:bg-[#7b1fa2] shadow-lg transition">Jadi Nasabah</a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-semibold border-2 border-[#1E5631] text-[#1E5631] hover:bg-[#1E5631]/5 transition">Masuk</a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        {{-- How it Works --}}
        <section id="cara-kerja" class="bg-gray-50 border-y border-gray-200 py-16 lg:py-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-[#1E5631] mb-4">Cara Kerja</h2>
                <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Pilah, jadwalkan jemput sampah, dan terima pembayaran ke saldo tabungan Anda.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 rounded-full bg-[#1E5631] text-white flex items-center justify-center text-xl font-bold mx-auto mb-4">1</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Pilah Sampah</h3>
                        <p class="text-gray-600 text-sm">Pisahkan plastik, kaca, dan kaleng sesuai kategori.</p>
                    </div>
                    <div class="text-center p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 rounded-full bg-[#8E24AA] text-white flex items-center justify-center text-xl font-bold mx-auto mb-4">2</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Jemput Sampah</h3>
                        <p class="text-gray-600 text-sm">Request penjemputan, pin lokasi di peta, pilih jadwal.</p>
                    </div>
                    <div class="text-center p-8 rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <div class="w-14 h-14 rounded-full bg-[#1E5631] text-white flex items-center justify-center text-xl font-bold mx-auto mb-4">3</div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Saldo Tabungan</h3>
                        <p class="text-gray-600 text-sm">Setelah verifikasi, dana masuk ke saldo tabungan Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- About Agape --}}
        <section id="tentang" class="py-16 lg:py-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-[#1E5631] mb-4">Tentang Agape</h2>
                <p class="text-center text-xl font-medium text-[#8E24AA] mb-6">Bank Sampah Induk Agape</p>
                <p class="text-center text-gray-600 max-w-3xl mx-auto mb-4">
                    Didirikan tahun 2018 oleh Budi Santoso, Bank Sampah Induk Agape lahir dari keprihatinan terhadap krisis sampah. Kami percaya setiap sampah punya nilai.
                </p>
                <p class="text-center text-gray-600 max-w-3xl mx-auto mb-10">
                    Bermitra dengan <strong>GreenIndo</strong> dan <strong>Pemerintah Kota</strong>, kami mengelola lebih dari 50 ton sampah dan melayani ratusan keluarga.
                </p>
                <blockquote class="max-w-2xl mx-auto text-center border-l-4 border-[#8E24AA] pl-6 py-2">
                    <p class="text-gray-800 italic">"Keberlanjutan bukan hanya tentang lingkungan, tapi masa depan anak-anak kita."</p>
                    <footer class="mt-2 text-sm font-semibold text-[#8E24AA]">Budi Santoso — Pendiri & Direktur, 2018</footer>
                </blockquote>
            </div>
        </section>

        {{-- Live Waste Prices --}}
        <section id="harga" class="bg-gray-50 border-y border-gray-200 py-16 lg:py-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-[#1E5631] mb-4">Harga Sampah Terkini</h2>
                <p class="text-center text-gray-600 mb-12">Harga per kg (dapat berubah). Login untuk request jemput sampah.</p>
                @php
                    try {
                        $prices = \App\Models\WastePrice::all()->groupBy('category');
                    } catch (\Throwable $e) {
                        $prices = collect();
                    }
                    $labels = ['plastic' => 'Plastik', 'glass' => 'Kaca', 'cans' => 'Kaleng'];
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($prices as $cat => $items)
                        <div class="rounded-xl bg-white border border-gray-200 p-6 shadow-sm">
                            <h3 class="font-semibold text-[#1E5631] mb-4">{{ $labels[$cat] ?? $cat }}</h3>
                            <ul class="space-y-2">
                                @foreach ($items as $p)
                                    <li class="flex justify-between text-sm">
                                        <span class="text-gray-700">{{ $p->name }}</span>
                                        <span class="font-semibold text-[#8E24AA]">Rp {{ number_format($p->price_per_kg, 0, ',', '.') }}/kg</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                @if ($prices->isEmpty())
                    <p class="text-center text-gray-500">Data harga akan tampil setelah diisi admin.</p>
                @endif
            </div>
        </section>

        {{-- CTA --}}
        <section class="bg-[#1E5631] text-white py-16 lg:py-20">
            <div class="max-w-3xl mx-auto px-4 text-center">
                <h2 class="text-2xl lg:text-3xl font-bold mb-4">Siap mulai mengubah sampah jadi rupiah?</h2>
                <p class="text-white/90 mb-8">Daftar sebagai nasabah dan request jemput sampah pertama Anda.</p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-semibold bg-[#8E24AA] text-white hover:bg-[#7b1fa2] shadow-lg">Daftar Sekarang</a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl font-semibold bg-white text-[#1E5631] hover:bg-gray-100 shadow-lg">Buka Dashboard</a>
                @endguest
            </div>
        </section>
    </main>

    <footer class="border-t border-gray-200 py-8 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Start Green – Bank Sampah Induk Agape. Ubah Sampah Jadi Rupiah.
        </div>
    </footer>
</body>
</html>
