
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Aspirasi Baru - U-Voice Telkom University</title>
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
                <a href="{{ route('aspirasi.index') }}" class="text-gray-600 hover:text-telkom-red font-semibold text-telkom-red">Aspirasi</a>
                <a href="{{ route('forum.index') }}" class="text-gray-600 hover:text-telkom-red">Forum</a>
            </nav>
            <div class="flex items-center">
                @auth
                    <div class="mr-4 flex items-center">
                        <a href="{{ route('profile.edit') }}" class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-2"></a>
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
        <h1 class="text-3xl font-bold mb-6 text-telkom-red text-center">Kirim Aspirasi Baru</h1>

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

        <div class="bg-white shadow-lg rounded-xl p-8 max-w-2xl mx-auto border-t-4 border-telkom-red">
            <form action="{{ route('aspirasi.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="himpunan_id" class="block text-gray-700 text-sm font-semibold mb-2">Tujuan Himpunan</label>
                    <select name="himpunan_id" id="himpunan_id"
                        class="border rounded-lg w-full py-2 px-3 text-gray-700 focus:ring-2 focus:ring-telkom-red focus:outline-none @error('himpunan_id') border-red-500 @enderror">
                        <option value="">Pilih Himpunan</option>
                        @foreach ($himpunans as $himpunan)
                            <option value="{{ $himpunan->id }}" {{ old('himpunan_id') == $himpunan->id ? 'selected' : '' }}>
                                {{ $himpunan->nama }} ({{ $himpunan->singkatan }})
                            </option>
                        @endforeach
                    </select>
                    @error('himpunan_id')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 text-sm font-semibold mb-2">Judul Aspirasi</label>
                    <input type="text" name="judul" id="judul" placeholder="Masukkan judul aspirasi Anda"
                        class="border rounded-lg w-full py-2 px-3 text-gray-700 focus:ring-2 focus:ring-telkom-red focus:outline-none @error('judul') border-red-500 @enderror"
                        value="{{ old('judul') }}">
                    @error('judul')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="konten" class="block text-gray-700 text-sm font-semibold mb-2">Isi Aspirasi</label>
                    <textarea name="konten" id="konten" rows="8" placeholder="Tulis aspirasi Anda di sini..."
                        class="border rounded-lg w-full py-2 px-3 text-gray-700 focus:ring-2 focus:ring-telkom-red focus:outline-none @error('konten') border-red-500 @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-telkom-red hover:bg-telkom-red-dark text-white font-bold py-2 px-6 rounded-lg shadow-md focus:outline-none transition duration-300 ease-in-out">
                        Kirim Aspirasi
                    </button>
                    <a href="{{ route('aspirasi.index') }}"
                        class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-telkom-red transition">
                        Batal
                    </a>
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