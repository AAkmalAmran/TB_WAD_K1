@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $aspirasi->judul }}</h1>

        <div class="mb-6 border-b pb-4">
            <p class="text-gray-700 text-base leading-relaxed">{{ $aspirasi->konten }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Pengirim:</p>
                @if(Auth::check() && Auth::id() === $aspirasi->user_id)
                    <p class="text-gray-800">{{ $aspirasi->mahasiswa_nama }} (NIM: {{ $aspirasi->mahasiswa_nim }})</p>
                @else
                    <p class="text-gray-800">Anonim</p>
                @endif
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Ditujukan Kepada:</p>
                <p class="text-gray-800">{{ $aspirasi->himpunan->nama ?? 'Himpunan Tidak Ditemukan' }} ({{ $aspirasi->himpunan->singkatan ?? '' }})</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Status:</p>
                <p class="font-bold
                    @if($aspirasi->status == 'pending') text-yellow-600
                    @elseif($aspirasi->status == 'diproses') text-blue-600
                    @elseif($aspirasi->status == 'diterima') text-green-600
                    @else text-red-600
                    @endif">
                    {{ ucfirst($aspirasi->status) }}
                </p>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-1">Tanggal Dikirim:</p>
                <p class="text-gray-800">{{ $aspirasi->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="mt-8 text-right">
            <a href="{{ route('aspirasi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kembali ke Daftar Aspirasi
            </a>
        </div>
    </div>
</div>
@endsection