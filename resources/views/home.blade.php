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
        <main class="flex-grow container mx-auto px-4 py-6">
            <!-- Notification -->
            @if (session('error') || session('success'))
                @php
                    $type = session('error') ? 'error' : 'success';
                    $message = session($type);
                    $bgColor =
                        $type === 'error'
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

            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-telkom-red to-red-700 rounded-xl shadow-lg p-6 mb-8 text-white">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-2/3 mb-6 md:mb-0">
                        @auth
                            <h1 class="text-2xl md:text-3xl font-bold mb-3">Selamat datang,
                                {{ Auth::user()->nama_panjang }}!</h1>
                        @else
                            <h1 class="text-2xl md:text-3xl font-bold mb-3">Selamat datang di U Voice!</h1>
                        @endauth
                        <p class="text-lg opacity-90 mb-4">Dapatkan update terkini dan berita seputar Telkom University
                            di sini!</p>

                        @if (session('status'))
                            <div class="bg-white bg-opacity-20 p-3 rounded-lg mb-4">
                                <span class="material-icons align-text-bottom mr-1">info</span>
                                {{ session('status') }}
                            </div>
                        @endif

                        @guest
                            <a href="{{ route('login') }}"
                                class="inline-block bg-white text-telkom-red font-medium py-2 px-5 rounded-lg hover:bg-gray-100 transition duration-300">
                                Masuk Sekarang
                            </a>
                        @endguest
                    </div>
                    <div class="md:w-1/3 flex justify-center">
                        <div class="bg-white bg-opacity-20 w-32 h-32 rounded-full flex items-center justify-center">
                            <span class="material-icons text-6xl">campaign</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Telkom University News Section -->
            @auth
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-telkom-dark">Berita Seputar Telkom University</h2>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Urutkan:</span>
                            <select
                                class="border rounded-lg px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-telkom-red">
                                <option>Terbaru</option>
                                <option>Populer</option>
                            </select>
                        </div>
                    </div>

                    @php
                        $beritaList = $beritas;
                        if (!request()->query('sort')) {
                            $beritaList = $beritas->sortByDesc('jumlah_komentar');
                        }
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($beritaList as $berita)
                            <div
                                class="bg-telkom-gray rounded-xl overflow-hidden shadow hover:shadow-xl transition duration-300">
                                <div class="p-5 cursor-pointer"
                                    onclick="window.location='{{ route('berita.komentar', $berita->id) }}'">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="text-xs font-medium text-telkom-red">
                                            {{ $berita->penulis->nama_panjang ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $berita->created_at->diffForHumans() }}</div>
                                    </div>
                                    <h3 class="text-lg font-bold text-telkom-dark mb-2">{{ $berita->judul }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ \Illuminate\Support\Str::limit($berita->isi, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                            <a href="{{ route('berita.komentar', $berita->id) }}"
                                                class="flex items-center gap-1 hover:text-telkom-red"
                                                onclick="event.stopPropagation()">
                                                <span class="material-icons text-base">chat_bubble_outline</span>
                                                {{ $berita->jumlah_komentar ?? 0 }} Komentar
                                            </a>
                                        </div>
                                        <a href="{{ route('berita.komentar', $berita->id) }}"
                                            class="text-telkom-red hover:text-telkom-red-dark font-medium text-sm">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-10">
                                <span class="material-icons text-4xl text-gray-400 mb-3">article</span>
                                <p class="text-gray-500">Belum ada berita</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- CNN News Section -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-telkom-dark">Berita CNN Indonesia Terbaru</h2>
                        <div class="text-sm text-gray-600">Update Terkini</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse (array_slice($cnnNews, 0, 4) as $news)
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                                @if (!empty($news['thumbnail']))
                                    <img src="{{ $news['thumbnail'] }}" alt="{{ $news['title'] }}"
                                        class="w-full h-40 object-cover">
                                @else
                                    <div class="bg-gray-200 h-40 flex items-center justify-center">
                                        <span class="material-icons text-4xl text-gray-400">image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="font-bold text-telkom-dark mb-2">{{ $news['title'] }}</h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ \Illuminate\Support\Str::limit($news['description'] ?? '', 80) }}</p>
                                    <a href="{{ $news['link'] }}" target="_blank"
                                        class="text-telkom-red hover:text-telkom-red-dark font-medium text-sm flex items-center">
                                        Baca Selengkapnya
                                        <span class="material-icons ml-1 text-base">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-4 text-center py-10">
                                <span class="material-icons text-4xl text-gray-400 mb-3">wifi_off</span>
                                <p class="text-gray-500">Tidak dapat memuat berita CNN</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endauth
        </main>

        <!-- Footer -->
        <footer class="bg-telkom-dark text-white mt-12">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4 text-telkom-red">U Voice</h3>
                        <p class="text-gray-400 text-sm">U-Voice adalah platform aspirasi mahasiswa Telkom University
                            yang memberikan wadah untuk menyampaikan pendapat, ide, dan kritik membangun demi kemajuan
                            kampus.
                        </p>
                    </div>
                    {{-- <div>
                        <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-white">Beranda</a></li>
                            <li><a href="#" class="hover:text-white">Berita</a></li>
                            <li><a href="#" class="hover:text-white">Aspirasi</a></li>
                        </ul>
                    </div> --}}
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
                    {{-- <div>
                        <h4 class="font-semibold mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-telkom-red w-10 h-10 rounded-full flex items-center justify-center hover:bg-telkom-red-dark transition">
                                <span class="material-icons">facebook</span>
                            </a>
                            <a href="#" class="bg-telkom-red w-10 h-10 rounded-full flex items-center justify-center hover:bg-telkom-red-dark transition">
                                <span class="material-icons">instagram</span>
                            </a>
                            <a href="#" class="bg-telkom-red w-10 h-10 rounded-full flex items-center justify-center hover:bg-telkom-red-dark transition">
                                <span class="material-icons">twitter</span>
                            </a>
                            <a href="#" class="bg-telkom-red w-10 h-10 rounded-full flex items-center justify-center hover:bg-telkom-red-dark transition">
                                <span class="material-icons">youtube</span>
                            </a>
                        </div> --}}
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                © 2025 UVoice. Hak Cipta Dilindungi.
            </div>
    </div>
    </footer>
    </div>
</body>

</html>