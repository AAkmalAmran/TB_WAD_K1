@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <!-- Left: Komentar & Form -->
    <div class="flex-1">
        <div class="max-w-2xl bg-white p-6 rounded shadow mx-auto">
            <h2 class="text-xl font-bold mb-4">{{ $berita->judul }}</h2>
            <div class="mb-2 text-gray-700">Oleh: {{ $berita->penulis->nama_panjang ?? '-' }}</div>
            <div class="mb-4 text-gray-600">{{ $berita->isi }}</div>
            <hr class="mb-4">
            <h3 class="font-semibold mb-2">Komentar</h3>
            <form action="{{ route('berita.komentar.store', $berita->id) }}" method="POST" class="mb-4 flex items-start gap-2">
                @csrf
                <textarea name="komentar" rows="3" class="w-full border rounded px-3 py-2 mb-2" placeholder="Tulis komentar..."></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-2">Kirim</button>
                <a href="{{ route('berita.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600 mt-2 transition">Kembali</a>
            </form>
            <div class="space-y-4">
                @php
                    $komentars = $berita->komentar()->with('user')->latest()->get();
                @endphp
                @forelse($komentars as $komentar)
                    <div class="p-3 bg-gray-100 rounded">
                        <div class="font-semibold text-sm text-gray-700">{{ $komentar->user->nama_panjang ?? '-' }}</div>
                        <div class="text-gray-800">{{ $komentar->isi }}</div>
                        <div class="text-xs text-gray-400">{{ $komentar->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <div class="text-gray-500 text-sm">Belum ada komentar.</div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Right: Rules -->
    <div class="w-full md:w-1/3 lg:w-1/4">
        <div class="bg-gray-200 p-6 rounded">
            <div class="font-semibold text-center mb-4">RULES</div>
            <div class="space-y-2">
                <div class="border-b border-gray-400 pb-2">1. Sampaikan aspirasi dengan sopan dan jelas.</div>
                <div class="border-b border-gray-400 pb-2">2. Tidak mengandung SARA, hoaks, atau ujaran kebencian.</div>
                <div class="border-b border-gray-400 pb-2">3. Gunakan bahasa yang mudah dipahami.</div>
            </div>
        </div>
    </div>
</div>
@endsection
