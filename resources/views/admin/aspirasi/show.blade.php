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

        <!-- Garis pemisah komentar -->
        <div class="border-t-4 border-gray-200 my-8"></div>
        <h2 class="text-xl font-bold mb-4 text-gray-700">Komentar</h2>

        <!-- Daftar Komentar -->
        @if($aspirasi->comments->count() > 0)
            <div class="space-y-4">
                @foreach($aspirasi->comments as $comment)
                    <div class="border-b pb-4 last:border-0">
                        <div class="flex items-start space-x-3">
                            <!-- Avatar User -->
                            <div class="flex-shrink-0">
                                @if($comment->user->foto)
                                    <img
                                        src="{{ asset('storage/public/' . $comment->user->foto) }}"
                                        alt="{{ $comment->user->nama_panggilan }}"
                                        class="w-10 h-10 rounded-full object-cover"
                                    >
                                @else
                                    <!-- Default avatar jika tidak ada foto -->
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-1">
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $comment->user->nama_panggilan }}
                                            @if($comment->user->is_admin)
                                                <span class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">Admin</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $comment->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    @if(Auth::check() && (Auth::id() == $comment->user_id || Auth::user()->is_admin))
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-red-500 hover:text-red-700 text-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                <p class="text-gray-700 mt-2">{{ $comment->isi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <p>Belum ada komentar</p>
            </div>
        @endif

        <div class="mt-8 text-right">
            <a href="{{ route('admin.aspirasi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Kembali ke Daftar Aspirasi
            </a>
        </div>
    </div>
</div>
@endsection