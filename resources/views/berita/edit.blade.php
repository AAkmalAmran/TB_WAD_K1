@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Berita</h2>
    <form action="{{ route('berita.update', $berita->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2" value="{{ old('judul', $berita->judul) }}" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Isi Berita</label>
            <textarea name="isi" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('isi', $berita->isi) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update</button>
        <a href="{{ route('berita.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
