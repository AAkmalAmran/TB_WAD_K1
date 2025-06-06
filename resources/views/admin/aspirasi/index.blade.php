@extends('layouts.app') {{-- Ganti dengan layout admin Anda jika ada, misalnya: 'layouts.admin' --}}

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Manajemen Aspirasi (Admin)</h1>

    {{-- Pesan sukses atau error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pengaju
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Isi Aspirasi
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- Menggunakan $aspirasi (singular) dari controller untuk loop --}}
                @forelse ($aspirasi as $item_aspirasi) {{-- Gunakan $item_aspirasi untuk setiap item loop --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item_aspirasi->id }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item_aspirasi->mahasiswa_nim }} - {{ $item_aspirasi->mahasiswa_nama }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ Str::limit($item_aspirasi->konten, 100) }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{-- INI ADALAH BAGIAN FORM UNTUK MENGGANTI STATUS --}}
                            <form action="{{ route('admin.aspirasi.update_status', $item_aspirasi->id) }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="block w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-900 text-sm">
                                    <option value="pending" {{ $item_aspirasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ $item_aspirasi->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="diterima" {{ $item_aspirasi->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $item_aspirasi->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm transition duration-150 ease-in-out">
                                    Ubah
                                </button>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </form>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm whitespace-no-wrap">
                            {{-- INI ADALAH TOMBOL UNTUK EDIT DETAIL LENGKAP DAN HAPUS --}}
                            <a href="{{ route('admin.aspirasi.show', $item_aspirasi->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-3 rounded text-xs transition duration-150 ease-in-out mr-1">Detail</a>
                            <a href="{{ route('admin.aspirasi.edit', $item_aspirasi->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-3 rounded text-xs transition duration-150 ease-in-out mr-1">Edit</a>
                            <form action="{{ route('admin.aspirasi.destroy', $item_aspirasi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded text-xs transition duration-150 ease-in-out">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                            Tidak ada aspirasi yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination links --}}
    <div class="mt-4">
        {{-- Menggunakan $aspirasi (singular) dari controller --}}
        {{ $aspirasi->links() }}
    </div>
</div>
@endsection