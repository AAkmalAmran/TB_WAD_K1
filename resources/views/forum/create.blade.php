@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-xl p-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Buat Topik Diskusi Baru</h1>
        <form action="{{ route('forum.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                <input type="text" name="judul" class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <input type="text" name="kategori" class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Opsional (ex: akademik, kegiatan)">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Isi</label>
                <textarea name="isi" rows="6" class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none" required></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <a href="{{ route('forum.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold transition">Posting</button>
            </div>
        </form>
    </div>
</div>
@endsection