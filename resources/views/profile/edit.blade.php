
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - U-Voice Telkom University</title>
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
                <a href="{{ route('berita.index') }}" class="text-gray-600 hover:text-telkom-red">Berita</a>
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

    <main class="container mx-auto p-6 flex-grow">
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
                <button class="absolute right-5 text-white font-bold" onclick="{{ $closeFunction }}()">X</button>
            </div>

            <script>
                function {{ $closeFunction }}() {
                    document.getElementById('{{ $id }}').classList.add('hidden');
                }
                setTimeout(function() {
                    var el = document.getElementById('{{ $id }}');
                    if (el) el.classList.add('hidden');
                }, 5000);
            </script>
        @endif

        <div class="bg-white p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Profil</h2>
            <form action="{{ route('profile.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">Full Name</label>
                        <input type="text" name="nama_panjang" value="{{ old('nama_panjang', $user->nama_panjang) }}"
                            class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panjang') border-red-500 @enderror">
                        @error('nama_panjang')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">Nick Name</label>
                        <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $user->nama_panggilan) }}"
                            class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panggilan') border-red-500 @enderror">
                        @error('nama_panggilan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2 font-semibold">Foto Profil</label>
                        <div class="flex flex-col md:flex-row items-center gap-6">
                            <input type="file" name="foto" id="fotoInput"
                                class="w-full md:w-1/2 bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('foto') border-red-500 @enderror" accept="image/*">
                            @if($user->foto)
                                <img id="previewFoto" src="{{ asset('storage/public/'.$user->foto) }}" alt="Foto Profil"
                                    class="w-24 h-24 rounded-full object-cover border-2 border-blue-200 shadow">
                            @else
                                <img id="previewFoto" src="{{ asset('avatar_default.png') }}" alt="Foto Profil"
                                    class="w-24 h-24 rounded-full object-cover border-2 border-gray-200 shadow">
                            @endif
                        </div>
                        @error('foto')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-10 flex justify-end gap-3">
                    <a href="{{ route('profile.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-2 rounded-lg font-semibold transition">Batal</a>
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-2 rounded-lg font-semibold transition">Simpan</button>
                </div>
            </form>
            <script>
            document.getElementById('fotoInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('previewFoto').src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
            </script>
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