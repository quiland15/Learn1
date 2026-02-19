@extends('auth.layout')

@section('title', 'Daftar')

@section('content')
<div class="w-full max-w-md">
    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-bold text-[#1E5631] mb-2">Daftar Nasabah</h1>
        <p class="text-gray-600 text-sm mb-6">Buat akun untuk request jemput sampah dan kelola saldo tabungan.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm p-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Nama Anda">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="nama@email.com">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata sandi</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Min. 8 karakter">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi kata sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="Ulangi kata sandi">
            </div>
            <button type="submit" class="w-full rounded-xl py-3 font-semibold text-white bg-[#8E24AA] hover:bg-[#7b1fa2] transition">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-[#8E24AA] hover:underline">Masuk</a>
        </p>
    </div>
</div>
@endsection
