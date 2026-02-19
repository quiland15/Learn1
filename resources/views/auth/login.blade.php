@extends('auth.layout')

@section('title', 'Masuk')

@section('content')
<div class="w-full max-w-md">
    <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
        <h1 class="text-2xl font-bold text-[#1E5631] mb-2">Masuk</h1>
        <p class="text-gray-600 text-sm mb-6">Masuk ke Start Green sebagai Nasabah atau Admin.</p>

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm p-3">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm p-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="nama@email.com">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata sandi</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]"
                    placeholder="••••••••">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-[#1E5631] focus:ring-[#1E5631]">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>
            <button type="submit" class="w-full rounded-xl py-3 font-semibold text-white bg-[#8E24AA] hover:bg-[#7b1fa2] transition">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-[#8E24AA] hover:underline">Daftar</a>
        </p>
    </div>
</div>
@endsection
