
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - U-Voice Telkom University</title>
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
    <main class="container mx-auto p-6 flex-grow">
        @if(session('error') || session('success'))
            @php
                $type = session('error') ? 'error' : 'success';
                $message = session($type);
                $bgColor = $type === 'error'
                    ? 'bg-red-100 border-l-4 border-red-500 text-red-700'
                    : 'bg-green-100 border-l-4 border-green-500 text-green-700';
                $id = $type . 'Message';
                $closeFunction = 'close' . ucfirst($type) . 'Message';
            @endphp

            <div id="{{ $id }}" class="{{ $bgColor }} p-4 rounded-lg mb-6 relative flex items-start">
                <span class="flex-grow">{{ $message }}</span>
                <button class="absolute right-5 top-3 text-gray-700 font-bold" onclick="{{ $closeFunction }}()">X</button>
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

        <div class="flex flex-col md:flex-row gap-6 justify-center">
            <!-- Kartu Kiri: Avatar & Info Singkat -->
            <div class="bg-white rounded-lg shadow-md p-8 flex flex-col items-center w-full md:w-1/3 border">
                <img src="{{ $user->foto ? asset('storage/public/'.$user->foto) : asset('avatar_default.png') }}" alt="Avatar" class="w-32 h-32 rounded-full mb-4 object-cover border">
                <h2 class="text-xl font-bold mb-1">{{ $user->nama_panggilan }}</h2>
                <p class="text-gray-500 mb-1">{{ $user->nama_panjang }}</p>
                <p class="text-gray-600 mb-1">{{ $user->email }}</p>
                <p class="text-gray-400 text-sm mb-4">{{ $user->fakultas ? $user->fakultas->nama_fakultas : '-' }}</p>
            </div>
            <!-- Kartu Kanan: Detail Profil -->
            <div class="bg-white rounded-lg shadow-md p-8 w-full md:w-2/3 flex flex-col justify-between border">
                <table class="w-full mb-6">
                    <tr>
                        <td class="font-semibold py-2 w-40">Full Name</td>
                        <td class="py-2">{{ $user->nama_panjang }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold py-2">Nick Name</td>
                        <td class="py-2">{{ $user->nama_panggilan }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold py-2">Email</td>
                        <td class="py-2">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold py-2">NIM</td>
                        <td class="py-2">{{ $user->nim }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold py-2">Fakultas</td>
                        <td class="py-2">{{ $user->fakultas ? $user->fakultas->nama_fakultas : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold py-2">Jurusan</td>
                        <td class="py-2">{{ $user->jurusan ? $user->jurusan->nama_jurusan : '-' }}</td>
                    </tr>
                </table>
                <div>
                    <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold">Edit</a>
                </div>
            </div>
        </div>

        <!-- Riwayat Aspirasi -->
        <div class="mt-10">
            <h3 class="text-xl font-bold mb-4">Riwayat Aspirasi</h3>
            @if($user->aspirasi && $user->aspirasi->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded shadow">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b font-semibold text-left">Judul</th>
                                <th class="py-2 px-4 border-b font-semibold text-left">Tanggal</th>
                                <th class="py-2 px-4 border-b font-semibold text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->aspirasi as $aspirasi)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $aspirasi->judul }}</td>
                                <td class="py-2 px-4 border-b">{{ $aspirasi->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="font-semibold
                                        @if($aspirasi->status == 'pending') text-yellow-600
                                        @elseif($aspirasi->status == 'diproses') text-blue-600
                                        @elseif($aspirasi->status == 'diterima') text-green-600
                                        @else text-red-600
                                        @endif">
                                        {{ ucfirst($aspirasi->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">Belum ada aspirasi yang ditulis.</p>
            @endif
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