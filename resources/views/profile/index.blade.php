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

    <div class="bg-white p-8 rounded shadow-lg">
        <h2 class="text-2xl font-bold mb-6">Profil User</h2>
        @if($users->isEmpty())
            <p class="text-gray-500">Tidak ada data user.</p>
        @else
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nama Panjang</th>
                        <th class="px-4 py-2 border">Nama Panggilan</th>
                        <th class="px-4 py-2 border">Email</th>
                        <th class="px-4 py-2 border">NIM</th>
                        <th class="px-4 py-2 border">Fakultas</th>
                        <th class="px-4 py-2 border">Jurusan</th>
                        <th class="px-4 py-2 border">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->nama_panjang }}</td>
                        <td class="px-4 py-2 border">{{ $user->nama_panggilan }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->nim }}</td>
                        <td class="px-4 py-2 border">{{ $user->fakultas }}</td>
                        <td class="px-4 py-2 border">{{ $user->jurusan }}</td>
                        <td class="px-4 py-2 border">{{ $user->role }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection