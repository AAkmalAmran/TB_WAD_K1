@extends('layouts.app')

@section('content')
@if(session('error') || session('success'))
    @php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $bgColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
        $id = $type . 'Message';
        $closeFunction = 'close' . ucfirst($type) . 'Message';
    @endphp

    <div id="{{ $id }}" class="{{ $bgColor }} text-white p-4 rounded-lg mb-6 relative">
        <span>{{ $message }}</span>
        <button class="absolute right-5 text-white font-bold" onclick="{{ $closeFunction }}()">X</button>
    </div>

    <script>
        function {{ $closeFunction }}() {
            document.getElementById('{{ $id }}').classList.add('hidden');
        }

        setTimeout(function() {
            var el = document.getElementById('{{ $id }}');
            if (el) el.classList.add('hidden');
        }, 5000);
    </script>
@endif

<div class="bg-white p-6 rounded shadow mb-4">
    @auth
        <h1 class="text-2xl font-semibold mb-2">Selamat datang, {{ Auth::user()->nama_panggilan }}!</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        <p class="text-gray-700 mb-4">Dapatkan update terkini dan berita seputar Telkom University di sini!</p>
        
    @else
        <h1 class="text-2xl font-semibold mb-2">Selamat datang!</h1>
        <p class="text-gray-700">Silakan login untuk mendapatkan pengalaman terbaik.</p>
    @endauth
</div>

<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Berita Seputar Telkom University Terbaru</h2>
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
            </div>
        </div>
    @empty
        <div class="text-gray-500">Belum ada berita.</div>
    @endforelse
</div>

<div class="bg-white p-6 rounded shadow mt-8">
    <h2 class="text-xl font-bold mb-4">Berita CNN Indonesia Terbaru</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse (array_slice($cnnNews, 0, 4) as $news)
            <div class="block bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
                @if(!empty($news['thumbnail']))
                    <img src="{{ $news['thumbnail'] }}" alt="{{ $news['title'] }}" class="w-full h-28 object-cover rounded mb-4">
                @endif
                <h2 class="text-lg font-semibold text-gray-900">{{ $news['title'] }}</h2>
                <p class="text-sm text-gray-700 mt-2 mb-2">{{ \Illuminate\Support\Str::limit($news['description'] ?? '', 100) }}</p>
                <a href="{{ $news['link'] }}" target="_blank" class="hover:underline text-blue-600 font-medium">Baca Selengkapnya</a>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-600 font-medium">
                Tidak Ada Berita CNN yang Tersedia.
            </div>
        @endforelse
    </div>
</div>
@endsection
