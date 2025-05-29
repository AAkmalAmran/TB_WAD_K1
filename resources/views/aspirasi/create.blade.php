@extends('layouts.app') {{-- Pastikan ini mengacu ke layout dasar Anda --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Kirim Aspirasi Baru</h1>

    <div class="bg-white shadow-lg rounded-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('aspirasi.store') }}" method="POST">
            @csrf {{-- Penting untuk keamanan Laravel --}}

            <div class="mb-4">
                <label for="himpunan_id" class="block text-gray-700 text-sm font-bold mb-2">Tujuan Himpunan:</label>
                <select name="himpunan_id" id="himpunan_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                        @error('himpunan_id') border-red-500 @enderror">
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
                <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Aspirasi:</label>
                <input type="text" name="judul" id="judul" placeholder="Masukkan judul aspirasi Anda"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                       @error('judul') border-red-500 @enderror" value="{{ old('judul') }}">
                @error('judul')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="konten" class="block text-gray-700 text-sm font-bold mb-2">Isi Aspirasi:</label>
                <textarea name="konten" id="konten" rows="8" placeholder="Tulis aspirasi Anda di sini..."
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                          @error('konten') border-red-500 @enderror">{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                    Kirim Aspirasi
                </button>
                <a href="{{ route('aspirasi.index') }}"
                   class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection