
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
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

    <div class="flex flex-col md:flex-row gap-6 justify-center">
        <!-- Kartu Kiri: Avatar & Info Singkat -->
        <div class="bg-white rounded-lg shadow-md p-8 flex flex-col items-center w-full md:w-1/3 border">
            <img src="{{ $user->foto ? asset('storage/public/'.$user->foto) : asset('avatar_default.png') }}" alt="Avatar" class="w-32 h-32 rounded-full mb-4 object-cover border">
            <h2 class="text-xl font-bold mb-1">{{ $user->nama_panggilan }}</h2>
            <p class="text-gray-500 mb-1">{{ $user->nama_panjang }}</p>
            <p class="text-gray-600 mb-1">{{ $user->email }}</p>
            <p class="text-gray-400 text-sm mb-4">{{ $user->jurusan }}, {{ $user->fakultas }}</p>
        </div>
        <!-- Kartu Kanan: Detail Profil -->
        <div class="bg-white rounded-lg shadow-md p-8 w-full md:w-2/3 flex flex-col justify-between border">
            <table class="w-full mb-6">
                <tr>
                    <td class="font-semibold py-2 w-40">Full Name</td>
                    <td class="py-2">{{ $user->nama_panjang }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Email</td>
                    <td class="py-2">{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">NIM</td>
                    <td class="py-2">{{ $user->nim }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Nick Name</td>
                    <td class="py-2">{{ $user->nama_panggilan }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Jurusan</td>
                    <td class="py-2">{{ $user->jurusan }}</td>
                </tr>
                <tr>
                    <td class="font-semibold py-2">Fakultas</td>
                    <td class="py-2">{{ $user->fakultas }}</td>
                </tr>
            </table>
            <div>
                <a href="{{ route('profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold">Edit</a>
            </div>
        </div>
    </div>

    <!-- Riwayat Aspirasi -->
    <div class="mt-10">
        <h3 class="text-xl font-bold mb-4">Riwayat Aspirasi</h3>
        @if($user->aspirasi && $user->aspirasi->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b font-semibold text-left">Judul</th>
                            <th class="py-2 px-4 border-b font-semibold text-left">Tanggal</th>
                            <th class="py-2 px-4 border-b font-semibold text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->aspirasi as $aspirasi)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $aspirasi->judul }}</td>
                            <td class="py-2 px-4 border-b">{{ $aspirasi->created_at->format('d M Y') }}</td>
                            <td class="py-2 px-4 border-b">{{ ucfirst($aspirasi->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Belum ada aspirasi yang ditulis.</p>
        @endif
    </div>
    
</div>
@endsection