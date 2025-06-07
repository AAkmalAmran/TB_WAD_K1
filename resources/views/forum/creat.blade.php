@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Topik Diskusi Baru</h1>
    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" placeholder="Opsional (ex: akademik, kegiatan)">
        </div>
        <div class="mb-3">
            <label>Isi</label>
            <textarea name="isi" rows="6" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Posting</button>
    </form>
</div>
@endsection
