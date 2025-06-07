<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - U-Voice Telkom University</title>
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
<body class="bg-telkom-gray font-sans min-h-screen flex flex-col">
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
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-telkom-red">Beranda</a>
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.aspirasi.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('admin/aspirasi*') ? 'font-semibold text-telkom-red' : '' }}">Kelola
                                Aspirasi</a>
                            <a href="{{ route('berita.index') }}"
                                class="text-gray-600 hover:text-telkom-red {{ Request::is('admin/berita*') ? 'font-semibold text-telkom-red' : '' }}">Kelola
                                Berita</a>
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
                        <a href="{{ route('profile.index') }}" class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-2"></a>
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
    <main class="container mx-auto p-4 flex flex-col md:flex-row gap-8 flex-grow">
        <!-- Left: List Berita -->
        <div class="flex-1">
            <h1 class="text-2xl font-bold mb-6 text-telkom-red">Berita</h1>
            @auth
            <a href="{{ route('berita.create') }}" class="inline-block bg-telkom-red hover:bg-telkom-red-dark text-white px-6 py-2 rounded mb-6 transition duration-300">
                Buat Berita
            </a>
            @endauth
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('berita.index') }}" class="bg-gray-100 px-3 py-1 rounded text-xs border hover:bg-telkom-red/10 {{ request()->query('sort') ? '' : 'font-bold underline' }}">Semua</a>
                <a href="{{ route('berita.index', ['sort' => 'terbaru']) }}" class="bg-gray-100 px-3 py-1 rounded text-xs border hover:bg-telkom-red/10 {{ request()->query('sort') == 'terbaru' ? 'font-bold underline' : '' }}">Terbaru</a>
            </div>
            <!-- Daftar Berita -->
            @php
                $beritaList = $beritas;
                if (!request()->query('sort')) {
                    // Sort by jumlah_komentar terbanyak (populer) untuk "Semua"
                    $beritaList = $beritas->sortByDesc('jumlah_komentar');
                }
            @endphp
            @forelse($beritaList as $berita)
            <div class="mb-6 pb-4 border-b select-none cursor-pointer hover:bg-telkom-gray transition"
                 onclick="window.location='{{ route('berita.komentar', $berita->id) }}'">
                <div class="font-semibold text-gray-700">{{ $berita->penulis->nama_panjang ?? '-' }}</div>
                <div class="text-lg font-bold text-telkom-dark">{{ $berita->judul }}</div>
                <div class="text-gray-600 text-sm mb-1">{{ \Illuminate\Support\Str::limit($berita->isi, 30) }}</div>
                <div class="text-xs text-gray-400 mb-2">{{ $berita->created_at->diffForHumans() }}</div>
                <div class="flex items-center gap-4 text-gray-500 text-sm">
                    <a href="{{ route('berita.komentar', $berita->id) }}" class="flex items-center gap-1 hover:text-telkom-red"
                       onclick="event.stopPropagation()">
                        <span class="material-icons text-base">chat_bubble_outline</span> {{ $berita->jumlah_komentar ?? 0 }}
                    </a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('berita.edit', $berita->id) }}" class="text-yellow-600 hover:underline ml-2" onclick="event.stopPropagation()">Edit</a>
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus berita ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2 bg-transparent border-none p-0 cursor-pointer" onclick="event.stopPropagation()">Hapus</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
            @empty
            <div class="text-gray-500">Belum ada berita.</div>
            @endforelse
        </div>
        <!-- Right: Kategori/Rules -->
        <div class="w-full md:w-1/3 lg:w-1/4">
            <div class="bg-gray-200 p-6 rounded">
                <div class="font-semibold text-center mb-4">RULES!!</div>
                <div class="space-y-2">
                    <div class="border-b border-gray-400 pb-2">1. Buatlah berita dengan bahasa yang sopan dan jelas.</div>
                    <div class="border-b border-gray-400 pb-2">2. Tidak mengandung SARA, hoaks, atau ujaran kebencian.</div>
                    <div class="border-b border-gray-400 pb-2">3. Gunakan bahasa yang mudah dipahami.</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
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