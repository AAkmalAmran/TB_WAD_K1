<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    {{-- Navbar --}}
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            {{-- Logo atau Nama Aplikasi --}}
            <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                {{ config('app.name', 'Forum Aspirasi') }}
            </a>

            {{-- Navigasi Utama --}}
            <div class="flex items-center space-x-4">
                <a href="{{ route('aspirasi.index') }}" class="text-gray-300 hover:text-white">Aspirasi</a>
                @auth {{-- Tampilkan jika user sudah login --}}
                    <a href="{{ route('aspirasi.create') }}" class="text-gray-300 hover:text-white">Kirim Aspirasi</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>

                    {{-- Logout Button (contoh) --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white">Logout</button>
                    </form>
                @else {{-- Tampilkan jika user belum login --}}
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- Bagian untuk Menampilkan Pesan Sukses/Error --}}
    <div class="container mx-auto px-4 mt-6">
        @if(session('error') || session('success'))
            @php
                $type = session('error') ? 'error' : 'success';
                $message = session($type);
                $bgColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
                $id = $type . 'Message';
                $closeFunction = 'close' . ucfirst($type) . 'Message';
            @endphp

            <div id="{{ $id }}" class="{{ $bgColor }} text-white p-4 rounded-lg mb-6 relative">
                <span>{{ $message }}</span>
                <button class="absolute top-0 right-0 mt-2 mr-4 text-white text-lg font-bold" onclick="{{ $closeFunction }}()">X</button>
            </div>

            <script>
                function {{ $closeFunction }}() {
                    document.getElementById('{{ $id }}').classList.add('hidden');
                }

                setTimeout(function() {
                    var el = document.getElementById('{{ $id }}');
                    if (el) el.classList.add('hidden');
                }, 5000); // Pesan akan hilang setelah 5 detik
            </script>
        @endif
    </div>

    {{-- Konten Halaman --}}
    <main>
        @yield('content')
    </main>
</body>
</html>