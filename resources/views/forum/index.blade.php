
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi General - U-Voice Telkom University</title>
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
                <a href="{{ route('aspirasi.index') }}" class="text-gray-600 hover:text-telkom-red">Aspirasi</a>
                <a href="{{ route('forum.index') }}" class="text-gray-600 hover:text-telkom-red font-semibold text-telkom-red">Forum</a>
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
    <main class="container mx-auto max-w-4xl p-6 flex-grow">
        <h1 class="text-3xl font-bold mb-8 text-telkom-red text-center">Forum Diskusi General</h1>
        <div class="flex justify-end mb-6">
            <a href="{{ route('forum.create') }}" class="bg-telkom-red hover:bg-telkom-red-dark text-white font-bold py-2 px-6 rounded-lg shadow transition">+ Buat Topik Baru</a>
        </div>

        @forelse($forums as $forum)
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                    <h4 class="text-xl font-semibold text-gray-900 mb-2 md:mb-0">{{ $forum->judul }}</h4>
                    <span class="text-sm text-gray-500">Kategori: <span class="font-medium text-blue-700">{{ $forum->kategori ?? 'Umum' }}</span></span>
                </div>
                <div class="text-gray-600 text-sm mb-2">oleh <span class="font-semibold">{{ $forum->user->name }}</span></div>
                <p class="text-gray-700 mb-4">{{ Str::limit($forum->isi, 150) }}</p>
                <div class="flex items-center gap-4">
                    @php
                        $userVote = Auth::check() ? \App\Models\ForumVote::where('user_id', Auth::id())->where('forum_id', $forum->id)->first() : null;
                    @endphp

                    <form action="{{ route('forum.upvote', $forum->id) }}" method="POST" class="inline">
                        @csrf
                        <button {{ $userVote && $userVote->type === 'upvote' ? 'disabled' : '' }} class="flex items-center gap-1 bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded transition font-semibold {{ $userVote && $userVote->type === 'upvote' ? 'opacity-50 cursor-not-allowed' : '' }}">
                            👍 <span>{{ $forum->upvote }}</span>
                        </button>
                    </form>
                    <form action="{{ route('forum.downvote', $forum->id) }}" method="POST" class="inline">
                        @csrf
                        <button {{ $userVote && $userVote->type === 'downvote' ? 'disabled' : '' }} class="flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded transition font-semibold {{ $userVote && $userVote->type === 'downvote' ? 'opacity-50 cursor-not-allowed' : '' }}">
                            👎 <span>{{ $forum->downvote }}</span>
                        </button>
                    </form>
                    @if(Route::has('forum.show'))
                        <a href="{{ route('forum.show', $forum->id) }}" class="ml-auto text-telkom-red hover:underline font-medium">Lihat Detail</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500 font-medium">
                Tidak ada topik forum.
            </div>
        @endforelse
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