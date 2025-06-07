
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="nama_panjang" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input id="nama_panjang" type="text" name="nama_panjang" value="{{ old('nama_panjang') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panjang') border-red-500 @enderror">
                @error('nama_panjang')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_panggilan" class="block text-sm font-semibold text-gray-700 mb-1">Nama Panggilan</label>
                <input id="nama_panggilan" type="text" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panggilan') border-red-500 @enderror">
                @error('nama_panggilan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-sm font-semibold text-gray-700 mb-1">NIM</label>
                <input id="nim" type="text" name="nim" value="{{ old('nim') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nim') border-red-500 @enderror">
                @error('nim')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fakultas_id" class="block text-sm font-semibold text-gray-700 mb-1">Fakultas</label>
                <select name="fakultas_id" id="fakultas_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('fakultas_id') border-red-500 @enderror">
                    <option value="">Pilih Fakultas</option>
                    @foreach ($fakultas as $f)
                        <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                            {{ $f->nama_fakultas ?? $f->nama }}
                        </option>
                    @endforeach
                </select>
                @error('fakultas_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jurusan_id" class="block text-sm font-semibold text-gray-700 mb-1">Program Studi</label>
                <select name="jurusan_id" id="jurusan_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('jurusan_id') border-red-500 @enderror">
                    <option value="">Pilih Program Studi</option>
                    @foreach ($jurusans as $j)
                        <option value="{{ $j->id }}" data-fakultas="{{ $j->fakultas_id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan ?? $j->nama }}
                        </option>
                    @endforeach
                </select>
                @error('jurusan_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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
                        jurusanSelect.appendChild(allJurusanOptions[0].cloneNode(true));
                        allJurusanOptions.forEach(option => {
                            if (option.value && option.getAttribute('data-fakultas') == fakultasId) {
                                jurusanSelect.appendChild(option.cloneNode(true));
                            }
                        });
                    });

                    if (fakultasSelect.value) {
                        fakultasSelect.dispatchEvent(new Event('change'));
                        @if(old('jurusan_id'))
                            jurusanSelect.value = "{{ old('jurusan_id') }}";
                        @endif
                    }
                });
            </script>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div class="mb-6">
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <p class="text-red-500 text-xs mt-1">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </p>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg shadow transition">
                Register
            </button>
        </form>
    </div>
</div>
@endsection