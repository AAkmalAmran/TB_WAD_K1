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

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Edit Profil</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-gray-700 mb-2 font-semibold">Full Name</label>
                    <input type="text" name="nama_panjang" value="{{ old('nama_panjang', $user->nama_panjang) }}"
                        class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panjang') border-red-500 @enderror">
                    @error('nama_panjang')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 mb-2 font-semibold">Nick Name</label>
                    <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $user->nama_panggilan) }}"
                        class="w-full bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('nama_panggilan') border-red-500 @enderror">
                    @error('nama_panggilan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 mb-2 font-semibold">Foto Profil</label>
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <input type="file" name="foto" id="fotoInput"
                            class="w-full md:w-1/2 bg-gray-50 rounded-lg p-3 border focus:ring-2 focus:ring-blue-400 focus:outline-none @error('foto') border-red-500 @enderror" accept="image/*">
                        @if($user->foto)
                            <img id="previewFoto" src="{{ asset('storage/public/'.$user->foto) }}" alt="Foto Profil"
                                class="w-24 h-24 rounded-full object-cover border-2 border-blue-200 shadow">
                        @else
                            <img id="previewFoto" src="{{ asset('avatar_default.png') }}" alt="Foto Profil"
                                class="w-24 h-24 rounded-full object-cover border-2 border-gray-200 shadow">
                        @endif
                    </div>
                    @error('foto')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mt-10 flex justify-end gap-3">
                <a href="{{ route('profile.index') }}"
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-8 py-2 rounded-lg font-semibold transition">Batal</a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-2 rounded-lg font-semibold transition">Simpan</button>
            </div>
        </form>
        <script>
        document.getElementById('fotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewFoto').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
        </script>
    </div>
</div>
@endsection