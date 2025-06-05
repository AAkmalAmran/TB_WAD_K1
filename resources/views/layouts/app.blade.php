<!DOCTYPE html>
<html>
<head>
    <title>SeputarTelkom</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/logo.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="/logo.png" alt="Logo" class="w-26 h-8">
            <span class="text-lg font-bold text-gray-800"></span>
        </a>
        <div>
            @auth
                <div class="flex items-center space-x-6">
                    @if(Auth::user()->role === 'mahasiswa')
                        {{-- Rute aspirasi.index adalah untuk menampilkan daftar aspirasi --}}
                        <a href="{{ route('aspirasi.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('aspirasi*') ? 'font-semibold underline' : '' }}">Aspiration</a>
                        {{-- Rute forum.show adalah untuk halaman forum --}}
                        <a href="{{ route('forum.show') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('forum*') ? 'font-semibold underline' : '' }}">Forum</a>
                        {{-- Menu baru: Berita --}}
                        <a href="{{ route('berita.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('berita*') ? 'font-semibold underline' : '' }}">Berita</a>
                        {{-- Rute profile.index adalah untuk halaman profil --}}
                        <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('profile') ? 'font-semibold underline' : '' }}">Profile</a>

                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('aspirasi.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('aspirasi*') ? 'font-semibold underline' : '' }}">Aspiration</a>
                        <a href="{{ route('forum.show') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('forum*') ? 'font-semibold underline' : '' }}">Forum</a>
                        {{-- Menu baru: Berita --}}
                        <a href="{{ route('berita.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('berita*') ? 'font-semibold underline' : '' }}">Berita</a>
                        <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-blue-600 {{ Request::is('admin/users*') ? 'font-semibold underline' : '' }}">Kelola User</a>
                    @endif
                    <div class="flex items-center space-x-3">
                            @if(Auth::user()->foto)
                                <img src="{{ asset('storage/public/' . Auth::user()->foto) }}" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover border">
                            @else
                                <span class="material-icons text-gray-600 text-4xl">
                                    account_circle
                                </span>
                            @endif
                        </span>
                        <div class="text-left leading-tight">
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->nama_panggilan }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                    

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                        <button type="submit"
                                class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                @if (Request::is('login'))
                    <a href="/register" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Register</a>
                @else
                    <a href="/login" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">Login</a>
                @endif
            @endauth
        </div>
    </nav>
    <div class="container mx-auto p-4">
        @yield('content')
    </div>
    {!! NoCaptcha::renderJs() !!}
</body>
</html>