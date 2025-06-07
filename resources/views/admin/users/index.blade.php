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

<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Daftar Mahasiswa</h2>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-blue-50">
                <tr>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Nama</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">NIM</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Fakultas</th>
                    <th class="py-3 px-6 text-left font-semibold text-gray-700">Jurusan</th>
                    <th class="py-3 px-6 text-center font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="hover:bg-blue-50 transition">
                    <td class="py-4 px-6 border-b border-gray-100">{{ $user->nama_panjang }}</td>
                    <td class="py-4 px-6 border-b border-gray-100">{{ $user->nim }}</td>
                    <td class="py-4 px-6 border-b border-gray-100">{{ $user->fakultas ? $user->fakultas->nama_fakultas : '-' }}</td>
                    <td class="py-4 px-6 border-b border-gray-100">{{ $user->jurusan ? $user->jurusan->nama_jurusan : '-' }}</td>
                    <td class="py-4 px-6 border-b border-gray-100 text-center">
                        <a href="{{ route('admin.users.show', $user) }}" class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition">Detail</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block text-red-600 hover:text-red-800 font-semibold ml-4 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 px-6 text-center text-gray-500">Belum ada data mahasiswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection