<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - U-Voice Telkom University</title>
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
    <style>
        .auth-card {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .auth-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        .form-input {
            transition: all 0.2s ease;
        }
        .form-input:focus {
            border-color: #E31B23;
            box-shadow: 0 0 0 3px rgba(227, 27, 35, 0.15);
        }
    </style>
</head>
{!! NoCaptcha::renderJs() !!}
<body class="bg-telkom-gray font-sans min-h-screen flex flex-col">
    <!-- Header Konsisten -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-telkom-red w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                    <span class="material-icons text-white text-2xl">campaign</span>
                </div>
                <h1 class="text-xl font-bold text-telkom-red">U-Voice</h1>
            </div>
            <nav class="hidden md:flex space-x-6">
                <a href="/" class="text-gray-600 hover:text-telkom-red">Beranda</a>
                <a href="/aspirasi" class="text-gray-600 hover:text-telkom-red">Aspirasi</a>
                <a href="/forum" class="text-gray-600 hover:text-telkom-red">Forum</a>
            </nav>
            <div class="flex items-center">
                <a href="/login" class="text-telkom-red hover:text-telkom-red-dark font-medium text-sm mr-4">
                    Masuk
                </a>
                <a href="/register" class="bg-telkom-red hover:bg-telkom-red-dark text-white py-1 px-3 rounded-lg text-sm font-medium transition duration-300">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content - Login -->
    <main class="flex-grow flex items-center justify-center py-12">
        <div class="w-full max-w-md px-4">
            <!-- Auth Card -->
            <div class="bg-white rounded-xl auth-card overflow-hidden">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-telkom-red to-red-700 p-6 text-center">
                    <div class="bg-white bg-opacity-20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="material-icons text-white text-4xl">lock</span>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Masuk ke Akun Anda</h2>
                    <p class="text-white opacity-90 mt-2">
                        Selamat datang kembali di portal U-Voice
                    </p>
                </div>

                <!-- Form Container -->
                <div class="p-6 md:p-8">
                    <!-- Notification -->
                    @if(session('error') || session('success'))
                        @php
                            $type = session('error') ? 'error' : 'success';
                            $message = session($type);
                            $bgColor = $type === 'error' ? 'bg-red-100 border-l-4 border-red-500 text-red-700' : 'bg-green-100 border-l-4 border-green-500 text-green-700';
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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-telkom-dark mb-1">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-4 py-3 form-input border rounded-lg focus:outline-none focus:ring-0 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-telkom-dark mb-1">Password</label>
                            <input id="password" type="password" name="password" required
                                class="w-full px-4 py-3 form-input border rounded-lg focus:outline-none focus:ring-0 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                    class="w-4 h-4 text-telkom-red focus:ring-telkom-red border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-telkom-dark">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="#" class="text-sm font-medium text-telkom-red hover:text-telkom-red-dark">
                                Lupa password?
                            </a>
                        </div>

                        <!-- reCAPTCHA -->
                        <div class="mb-6 flex justify-center">
                            {!! NoCaptcha::display() !!}
                        </div>
                        @if ($errors->has('g-recaptcha-response'))
                            <p class="text-red-500 text-sm mt-1 text-center">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </p>
                        @endif

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-telkom-red hover:bg-telkom-red-dark text-white py-3 px-4 rounded-lg font-medium transition duration-300">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <!-- Toggle Form -->
                    <div class="mt-6 text-center">
                        <p class="text-telkom-dark text-sm">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-telkom-red inline-flex items-center">
                                Daftar sekarang
                                <span class="material-icons ml-1 text-base">arrow_forward</span>
                            </a>
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-300"></div>
                        {{-- <span class="mx-4 text-gray-500 text-sm">atau</span> --}}
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <!-- Social Login -->
                    {{-- <div class="grid grid-cols-2 gap-3">
                        <a href="#" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg text-telkom-dark hover:bg-gray-50 transition">
                            <div class="w-5 h-5 mr-2 bg-blue-500 rounded-full"></div>
                            <span class="text-sm font-medium">Facebook</span>
                        </a>
                        <a href="#" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg text-telkom-dark hover:bg-gray-50 transition">
                            <div class="w-5 h-5 mr-2 bg-red-500 rounded-full"></div>
                            <span class="text-sm font-medium">Google</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
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
{!! NoCaptcha::renderJs() !!}
</body>
</html>