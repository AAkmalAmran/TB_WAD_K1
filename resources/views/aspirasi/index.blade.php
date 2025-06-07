<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telkom University - Beranda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'telkom-red': '#E31B23',
                        'telkom-red-dark': '#C0161D',
                        'telkom-gray': '#F5F5F5',
                        'telkom-dark': '#333333',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-telkom-gray font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-telkom-red w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                        <span class="material-icons text-white text-2xl">campaign</span>
                    </div>
                    <h1 class="text-xl font-bold text-telkom-red">U-Voice</h1>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}"
                        class="text-telkom-red font-medium {{ Request::is('/') ? 'border-b-2 border-telkom-red' : '' }}">Beranda</a>

                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.aspirasi.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('admin/aspirasi*') ? 'font-semibold text-telkom-red' : '' }}">Kelola
                                Aspirasi</a>
                            <a href="{{ route('berita.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('admin/berita*') ? 'font-semibold text-telkom-red' : '' }}">Kelola
                                Berita</a>
                            <a href="{{ route('admin.users.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('admin/users*') ? 'font-semibold text-telkom-red' : '' }}">Kelola
                                User</a>
                        @else
                            <a href="{{ route('aspirasi.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('aspirasi*') ? 'font-semibold text-telkom-red' : '' }}">Aspirasi</a>
                            <a href="{{ route('forum.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('forum*') ? 'font-semibold text-telkom-red' : '' }}">Forum</a>
                        @endif
                    @endauth
                </nav>

                <div class="flex items-center">
                    @auth
                        <div class="mr-4 flex items-center">
                            <a href="{{ route('profile.index') }} "
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-2"></a>
                            <span class="text-sm font-medium text-telkom-dark">{{ Auth::user()->nama_panggilan }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-telkom-red hover:bg-telkom-red-dark text-white py-1 px-3 rounded-lg text-sm font-medium transition duration-300">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-telkom-red hover:bg-telkom-red-dark text-white py-1 px-3 rounded-lg text-sm font-medium transition duration-300">
                            Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </header>


    <!-- Main Content -->
    <main class="container mx-auto p-4 flex-grow">
        <h1 class="text-3xl font-bold mb-6 text-telkom-red text-center">Forum Aspirasi Mahasiswa</h1>

        <!-- Notifikasi -->
        @if(session('error') || session('success'))
            @php
                $type = session('error') ? 'error' : 'success';
                $message = session($type);
                $bgColor = $type === 'error'
                    ? 'bg-red-100 border-l-4 border-red-500 text-red-700'
                    : 'bg-green-100 border-l-4 border-green-500 text-green-700';
                $icon = $type === 'error' ? 'error_outline' : 'check_circle_outline';
            @endphp
            <div class="{{ $bgColor }} p-4 rounded mb-6 relative flex items-start">
                <span class="material-icons mr-3">{{ $icon }}</span>
                <span class="flex-grow">{{ $message }}</span>
                <button class="text-gray-500 hover:text-gray-700" onclick="this.parentElement.remove()">
                    <span class="material-icons">close</span>
                </button>
            </div>
        @endif

        <div class="flex justify-end items-center mb-6">
            <a href="{{ route('aspirasi.create') }}" class="bg-telkom-red hover:bg-telkom-red-dark text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kirim Aspirasi Baru
            </a>
        </div>

        @if ($aspirasi->isEmpty())
            <div class="bg-white shadow-lg rounded-lg p-8 text-center">
                <p class="text-gray-600 text-lg">Belum ada aspirasi yang tersedia.</p>
                <p class="text-gray-500 mt-2">Jadilah yang pertama mengirim aspirasi!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($aspirasi as $item_aspirasi)
                    <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out flex flex-col justify-between border-t-4 border-telkom-red">
                        <div>
                            <h2 class="text-xl font-semibold mb-2 text-telkom-red">{{ $item_aspirasi->judul }}</h2>
                            <p class="text-gray-700 mb-3 text-sm leading-relaxed">{{ Str::limit($item_aspirasi->konten, 150) }}</p>
                        </div>
                        <div class="mt-4 text-sm text-gray-600">
                            <p class="mb-1">
                                Oleh: 
                                @if(Auth::check() && Auth::id() === $item_aspirasi->user_id)
                                    {{ $item_aspirasi->mahasiswa_nama }} (NIM: {{ $item_aspirasi->mahasiswa_nim }})
                                @else
                                    Anonim
                                @endif
                            </p>
                            <p class="mb-1">
                                Untuk: <span class="font-medium text-blue-700">{{ $item_aspirasi->himpunan->nama ?? 'Himpunan Tidak Ditemukan' }}</span>
                            </p>
                            <p class="mb-1">
                                Status: <span class="font-medium
                                @if($item_aspirasi->status == 'pending') text-yellow-600
                                @elseif($item_aspirasi->status == 'diproses') text-blue-600
                                @elseif($item_aspirasi->status == 'diterima') text-green-600
                                @else text-red-600
                                @endif">
                                {{ ucfirst($item_aspirasi->status) }}
                                </span>
                            </p>
                            <p class="text-xs text-gray-500 mt-2">
                                Dikirim: {{ $item_aspirasi->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <div class="mt-5 text-right">
                            <a href="{{ route('aspirasi.show', $item_aspirasi->id) }}" class="text-telkom-red hover:text-telkom-red-dark font-medium transition duration-300 ease-in-out flex items-center gap-1">
                                Baca Selengkapnya <span class="material-icons text-base align-middle">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $aspirasi->links() }}
            </div>
        @endif
    </main>

    <!-- Footer Konsisten -->
    <footer class="bg-telkom-dark text-white mt-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-telkom-red">U Voice</h3>
                    <p class="text-gray-400 text-sm">U-Voice adalah platform aspirasi mahasiswa Telkom University yang memberikan wadah untuk menyampaikan pendapat, ide, dan kritik membangun demi kemajuan kampus.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="/" class="hover:text-white">Beranda</a></li>
                        <li><a href="#" class="hover:text-white">Berita</a></li>
                        <li><a href="#" class="hover:text-white">Aspirasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak Kami</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <span class="material-icons mr-2 text-base">location_on</span>
                            Jl. Telekomunikasi Terusan Buah Batu, Bandung
                        </li>
                        <li class="flex items-start">
                            <span class="material-icons mr-2 text-base">call</span>
                            (022) 7564108
                        </li>
                        <li class="flex items-start">
                            <span class="material-icons mr-2 text-base">email</span>
                            info@telkomuniversity.ac.id
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                © 2025 UVoice. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>