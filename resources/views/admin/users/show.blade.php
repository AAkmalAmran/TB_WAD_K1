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

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Profil Mahasiswa</h2>
    <div class="relative bg-white rounded-lg shadow-md p-8 flex flex-col items-center w-full md:w-1/2 mx-auto border">
        <a href="{{ route('admin.users.index') }}" class="absolute top-4 left-4 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm shadow transition">
            &larr; Kembali
        </a>
        <img src="{{ $user->foto ? asset('storage/public/' . $user->foto) : asset('avatar_default.png') }}" alt="Avatar" class="w-32 h-32 rounded-full mb-4 object-cover border">
        <h2 class="text-xl font-bold mb-1">{{ $user->nama_panggilan }}</h2>
        <p class="text-gray-500 mb-1">{{ $user->nama_panjang }}</p>
        <p class="text-gray-600 mb-1">{{ $user->email }}</p>
        <p class="text-gray-400 text-sm mb-4">{{ $user->jurusan }}, {{ $user->fakultas }}</p>
        <p class="text-gray-400 text-sm mb-4">NIM: {{ $user->nim }}</p>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded font-semibold">Hapus User</button>
        </form>
    </div>
</div>
@endsection