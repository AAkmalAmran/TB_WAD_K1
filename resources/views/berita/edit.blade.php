
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - U-Voice Telkom University</title>
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
                <a href="{{ route('forum.index') }}" class="text-gray-600 hover:text-telkom-red">Forum</a>
                <a href="{{ route('berita.index') }}" class="text-gray-600 hover:text-telkom-red font-semibold text-telkom-red">Berita</a>
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
    <main class="container mx-auto p-4 flex-grow">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg border-t-4 border-telkom-red">
            <h2 class="text-2xl font-bold mb-6 text-telkom-red text-center">Edit Berita</h2>
            <form action="{{ route('berita.update', $berita->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label class="block mb-1 font-semibold text-gray-700">Judul</label>
                    <input type="text" name="judul" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-telkom-red focus:outline-none" value="{{ old('judul', $berita->judul) }}" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-1 font-semibold text-gray-700">Isi Berita</label>
                    <textarea name="isi" rows="7" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-telkom-red focus:outline-none" required>{{ old('isi', $berita->isi) }}</textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('berita.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold transition">Batal</a>
                    <button type="submit" class="bg-telkom-red hover:bg-telkom-red-dark text-white px-8 py-2 rounded-lg font-semibold transition">Update</button>
                </div>
            </form>
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