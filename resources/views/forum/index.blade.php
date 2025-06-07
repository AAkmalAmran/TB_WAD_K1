@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl p-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Forum Diskusi General</h1>
    <div class="flex justify-end mb-6">
        <a href="{{ route('forum.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">+ Buat Topik Baru</a>
    </div>

    @forelse($forums as $forum)
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                <h4 class="text-xl font-semibold text-gray-900 mb-2 md:mb-0">{{ $forum->judul }}</h4>
                <span class="text-sm text-gray-500">Kategori: <span class="font-medium text-blue-700">{{ $forum->kategori ?? 'Umum' }}</span></span>
            </div>
            <div class="text-gray-600 text-sm mb-2">oleh <span class="font-semibold">{{ $forum->user->name }}</span></div>
            <p class="text-gray-700 mb-4">{{ Str::limit($forum->isi, 150) }}</p>
            <div class="flex items-center gap-4">
                @php
                    $userVote = Auth::check() ? \App\Models\ForumVote::where('user_id', Auth::id())->where('forum_id', $forum->id)->first() : null;
                @endphp

                <form action="{{ route('forum.upvote', $forum->id) }}" method="POST" class="inline">
                    @csrf
                    <button {{ $userVote && $userVote->type === 'upvote' ? 'disabled' : '' }} class="flex items-center gap-1 bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded transition font-semibold {{ $userVote && $userVote->type === 'upvote' ? 'opacity-50 cursor-not-allowed' : '' }}">
                        👍 <span>{{ $forum->upvote }}</span>
                    </button>
                </form>
                <form action="{{ route('forum.downvote', $forum->id) }}" method="POST" class="inline">
                    @csrf
                    <button {{ $userVote && $userVote->type === 'downvote' ? 'disabled' : '' }} class="flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded transition font-semibold {{ $userVote && $userVote->type === 'downvote' ? 'opacity-50 cursor-not-allowed' : '' }}">
                        👎 <span>{{ $forum->downvote }}</span>
                    </button>
                </form>
                {{-- Tambahkan tombol lihat detail jika ada route forum.show --}}
                @if(Route::has('forum.show'))
                    <a href="{{ route('forum.show', $forum->id) }}" class="ml-auto text-blue-600 hover:underline font-medium">Lihat Detail</a>
                @endif
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500 font-medium">
            Tidak ada topik forum.
        </div>
    @endforelse
</div>
@endsection