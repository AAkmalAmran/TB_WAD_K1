@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <!-- Left: List Berita -->
    <div class="flex-1">
        <h1 class="text-2xl font-bold mb-6">Berita</h1>
        @auth
        <a href="{{ route('berita.create') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded mb-6 hover:bg-blue-600 transition duration-300">
            Buat Berita
        </a>
        @endauth
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('berita.index') }}" class="bg-gray-100 px-3 py-1 rounded text-xs border hover:bg-blue-100 {{ request()->query('sort') ? '' : 'font-bold underline' }}">Semua</a>
            <a href="{{ route('berita.index', ['sort' => 'terbaru']) }}" class="bg-gray-100 px-3 py-1 rounded text-xs border hover:bg-blue-100 {{ request()->query('sort') == 'terbaru' ? 'font-bold underline' : '' }}">Terbaru</a>
        </div>
        <!-- Daftar Berita -->
        @php
            $beritaList = $beritas;
            if (!request()->query('sort')) {
                // Sort by jumlah_komentar terbanyak (populer) untuk "Semua"
                $beritaList = $beritas->sortByDesc('jumlah_komentar');
            }
        @endphp
        @forelse($beritaList as $berita)
        <div class="mb-6 pb-4 border-b select-none cursor-pointer hover:bg-gray-100 transition"
             onclick="window.location='{{ route('berita.komentar', $berita->id) }}'">
            <div class="font-semibold text-gray-700">{{ $berita->penulis->nama_panjang ?? '-' }}</div>
            <div class="text-lg font-bold">{{ $berita->judul }}</div>
            <div class="text-gray-600 text-sm mb-1">{{ \Illuminate\Support\Str::limit($berita->isi, 30) }}</div>
            <div class="text-xs text-gray-400 mb-2">{{ $berita->created_at->diffForHumans() }}</div>
            <div class="flex items-center gap-4 text-gray-500 text-sm">
                <a href="{{ route('berita.komentar', $berita->id) }}" class="flex items-center gap-1 hover:text-blue-600"
                   onclick="event.stopPropagation()">
                    <span class="material-icons text-base">chat_bubble_outline</span> {{ $berita->jumlah_komentar ?? 0 }}
                </a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('berita.edit', $berita->id) }}" class="text-yellow-600 hover:underline ml-2" onclick="event.stopPropagation()">Edit</a>
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus berita ini?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2 bg-transparent border-none p-0 cursor-pointer" onclick="event.stopPropagation()">Hapus</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
        @empty
        <div class="text-gray-500">Belum ada berita.</div>
        @endforelse
    </div>
    <!-- Right: Kategori -->
    <div class="w-full md:w-1/3 lg:w-1/4">
        <div class="bg-gray-200 p-6 rounded">
            <div class="font-semibold text-center mb-4">RULES!!</div>
            <div class="space-y-2">
                <div class="border-b border-gray-400 pb-2">1. Buatlah berita dengan bahasa yang sopan dan jelas.</div>
                <div class="border-b border-gray-400 pb-2">2. Tidak mengandung SARA, hoaks, atau ujaran kebencian.</div>
                <div class="border-b border-gray-400 pb-2">3. Gunakan bahasa yang mudah dipahami.</div>
            </div>
        </div>
    </div>
</div>
@endsection
