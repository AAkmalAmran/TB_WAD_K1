@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forum Diskusi General</h1>
    <a href="{{ route('forum.create') }}" class="btn btn-primary mb-3">+ Buat Topik Baru</a>

    @foreach($forums as $forum)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $forum->judul }}</h4>
                <p class="text-muted">Kategori: {{ $forum->kategori ?? 'Umum' }} | oleh {{ $forum->user->name }}</p>
                <p>{{ Str::limit($forum->isi, 150) }}</p>
                
                <form action="{{ route('forum.upvote', $forum->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">👍 {{ $forum->upvote }}</button>
                </form>

                <form action="{{ route('forum.downvote', $forum->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger btn-sm">👎 {{ $forum->downvote }}</button>
                </form>S
            </div>
        </div>
    @endforeach
</div>
@endsection
