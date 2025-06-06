@extends('layouts.app') {{-- Ganti dengan layout admin Anda jika ada, misalnya: 'layouts.admin' --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6 text-center">Edit Aspirasi</h1>

    {{-- Pesan sukses atau error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Form untuk mengedit aspirasi --}}
    <form action="{{ route('admin.aspirasi.update', $aspirasi->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT') {{-- Menggunakan PUT method untuk update resource --}}

        {{-- Field Judul --}}
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">
                Judul Aspirasi:
            </label>
            <input type="text" name="judul" id="judul"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul') border-red-500 @enderror"
                   value="{{ old('judul', $aspirasi->judul) }}" required autofocus>
            @error('judul')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        {{-- Field Konten/Isi Aspirasi --}}
        <div class="mb-4">
            <label for="konten" class="block text-gray-700 text-sm font-bold mb-2">
                Isi Aspirasi:
            </label>
            <textarea name="konten" id="konten" rows="6"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('konten') border-red-500 @enderror"
                              required>{{ old('konten', $aspirasi->konten) }}</textarea>
            @error('konten')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        {{-- Field Himpunan Tujuan --}}
            <div class="mb-4">
                <label for="himpunan_id" class="block text-gray-700 text-sm font-bold mb-2">
                    Himpunan Tujuan:
                </label>
                <select name="himpunan_id" id="himpunan_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('himpunan_id') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Himpunan</option>
                    @foreach ($himpunans as $himpunan)
                        <option value="{{ $himpunan->id }}" {{ old('himpunan_id', $aspirasi->himpunan_id) == $himpunan->id ? 'selected' : '' }}>
                            {{ $himpunan->himpunans }} {{-- Sesuaikan dengan nama kolom yang benar dari model Himpunan Anda --}}
                        </option>
                    @endforeach
                </select>
                @error('himpunan_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Status --}}
            <div class="mb-6">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                    Status Aspirasi:
                </label>
                <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror"
                        required>
                    <option value="pending" {{ old('status', $aspirasi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ old('status', $aspirasi->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="diterima" {{ old('status', $aspirasi->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status', $aspirasi->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit dan Batal --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.aspirasi.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
    @endsection