@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Forum Aspirasi Mahasiswa</h1>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('aspirasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
            Kirim Aspirasi Baru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Ubah $aspirasis menjadi $aspirasi --}}
    @if ($aspirasi->isEmpty())
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
            <p class="text-gray-600 text-lg">Belum ada aspirasi yang tersedia.</p>
            <p class="text-gray-500 mt-2">Jadilah yang pertama mengirim aspirasi!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Ubah $aspirasis menjadi $aspirasi --}}
            @foreach ($aspirasi as $item_aspirasi) {{-- Ganti $aspirasi di foreach dengan nama lain agar tidak konflik --}}
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300 ease-in-out flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold mb-2 text-gray-900">{{ $item_aspirasi->judul }}</h2>
                        <p class="text-gray-700 mb-3 text-sm leading-relaxed">{{ Str::limit($item_aspirasi->konten, 150) }}</p>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        <p class="mb-1">
                            **Oleh:** {{ $item_aspirasi->mahasiswa_nama }} (NIM: {{ $item_aspirasi->mahasiswa_nim }})
                        </p>
                        <p class="mb-1">
                            **Untuk:** <span class="font-medium text-blue-700">{{ $item_aspirasi->himpunan->nama ?? 'Himpunan Tidak Ditemukan' }}</span>
                        </p>
                        <p class="mb-1">
                            **Status:** <span class="font-medium
                            @if($item_aspirasi->status == 'pending') text-yellow-600
                            @elseif($item_aspirasi->status == 'diproses') text-blue-600
                            @elseif($item_aspirasi->status == 'diterima') text-green-600
                            @else text-red-600
                            @endif">
                            {{ ucfirst($item_aspirasi->status) }}
                            </span>
                        </p>
                        <p class="text-xs text-gray-500 mt-2">
                            Dikirim: {{ $item_aspirasi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <div class="mt-5 text-right">
                        <a href="{{ route('aspirasi.show', $item_aspirasi->id) }}" class="text-blue-600 hover:text-blue-800 font-medium transition duration-300 ease-in-out">
                            Baca Selengkapnya <span class="material-icons text-base align-middle">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{-- Ubah $aspirasis menjadi $aspirasi --}}
            {{ $aspirasi->links() }} {{-- Tampilkan pagination links --}}
        </div>
    @endif
</div>
@endsection