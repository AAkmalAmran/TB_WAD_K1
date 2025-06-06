@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="nama_panjang" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="nama_panjang" type="text" name="nama_panjang" value="{{ old('nama_panjang') }}" required autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama_panjang') border-red-500 @enderror">
                @error('nama_panjang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_panggilan" class="block text-sm font-medium text-gray-700">Nama Panggilan</label>
                <input id="nama_panggilan" type="text" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama_panggilan') border-red-500 @enderror">
                @error('nama_panggilan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nim') border-red-500 @enderror">
                @error('nim')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fakultas_id" class="block text-gray-700 text-sm font-bold mb-2">Fakultas:</label>
                <select name="fakultas_id" id="fakultas_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('fakultas_id') border-red-500 @enderror">
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultas as $f)
                        <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                            {{ $f->nama_fakultas ?? $f->nama }}
                        </option>
                    @endforeach
                </select>
                @error('fakultas_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jurusan_id" class="block text-gray-700 text-sm font-bold mb-2">Program Studi:</label>
                <select name="jurusan_id" id="jurusan_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    @error('jurusan_id') border-red-500 @enderror">
                    <option value="">Pilih Program Studi</option>
                    @foreach ($jurusans as $j)
                        <option value="{{ $j->id }}" data-fakultas="{{ $j->fakultas_id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan ?? $j->nama }}
                        </option>
                    @endforeach
                </select>
                @error('jurusan_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const fakultasSelect = document.getElementById('fakultas_id');
                    const jurusanSelect = document.getElementById('jurusan_id');
                    const allJurusanOptions = Array.from(jurusanSelect.options);

                    fakultasSelect.addEventListener('change', function () {
                        const fakultasId = this.value;
                        jurusanSelect.innerHTML = '';
                        jurusanSelect.appendChild(allJurusanOptions[0].cloneNode(true)); // Option "Pilih Program Studi"
                        allJurusanOptions.forEach(option => {
                            if (option.value && option.getAttribute('data-fakultas') == fakultasId) {
                                jurusanSelect.appendChild(option.cloneNode(true));
                            }
                        });
                    });

                    // Trigger filter on page load if old value exists
                    if (fakultasSelect.value) {
                        fakultasSelect.dispatchEvent(new Event('change'));
                        // Set selected jurusan if old value exists
                        @if(old('jurusan_id'))
                            jurusanSelect.value = "{{ old('jurusan_id') }}";
                        @endif
                    }
                });
            </script>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4"> {{-- Mengurangi margin bottom dari mb-8 menjadi mb-4 untuk reCAPTCHA --}}
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- Tambahkan Bagian reCAPTCHA di sini --}}
            <div class="mb-8"> {{-- Memberi margin bottom sebelum tombol submit --}}
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <p class="text-red-500 text-sm mt-1">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </p>
                @endif
            </div>
            {{-- Akhir Bagian reCAPTCHA --}}

            <div class="flex justify-center items-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection