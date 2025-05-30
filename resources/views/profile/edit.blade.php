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
        <h2 class="text-2xl font-bold mb-6">Edit Profil</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="nama_panjang" value="{{ old('nama_panjang', $user->nama_panjang) }}" class="w-full bg-gray-100 rounded-lg p-3 @error('nama_panjang') border-red-500 @enderror">
                    @error('nama_panjang')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Nick Name</label>
                    <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $user->nama_panggilan) }}" class="w-full bg-gray-100 rounded-lg p-3 @error('nama_panggilan') border-red-500 @enderror">
                    @error('nama_panggilan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" class="w-full bg-gray-100 rounded-lg p-3 @error('jurusan') border-red-500 @enderror">
                    @error('jurusan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Fakultas</label>
                    <input type="text" name="fakultas" value="{{ old('fakultas', $user->fakultas) }}" class="w-full bg-gray-100 rounded-lg p-3 @error('fakultas') border-red-500 @enderror">
                    @error('fakultas')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" class="w-full bg-gray-100 rounded-lg p-3 @error('nim') border-red-500 @enderror">
                    @error('nim')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Foto Profil</label>
                    <input type="file" name="foto" class="w-full bg-gray-100 rounded-lg p-3 @error('foto') border-red-500 @enderror">
                    @error('foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    @if($user->foto)
                        <img src="{{ asset('storage/public/'.$user->foto) }}" alt="Foto Profil" class="w-24 h-24 rounded-full mt-2 object-cover">
                    @endif
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('profile.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold mr-2">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection