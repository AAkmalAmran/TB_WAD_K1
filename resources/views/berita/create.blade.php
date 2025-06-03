@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Buat Berita Baru</h2>
    <form action="{{ route('berita.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Isi Berita</label>
            <textarea name="isi" rows="6" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Simpan</button>
        <a href="{{ route('berita.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
