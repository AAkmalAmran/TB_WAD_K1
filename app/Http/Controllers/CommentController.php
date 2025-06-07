<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Menyimpan komentar baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aspirasi  $aspirasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, string $aspirasi_id)
    {
        // Cari aspirasi berdasarkan ID
        $aspirasi = Aspirasi::findOrFail($aspirasi_id);

        // Authorisasi: Hanya user yang login yang boleh komentar
        if (Auth::guest()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan komentar.');
        }

        // Alternatif tanpa Gate (gunakan salah satu):
        // if (!Auth::check()) {
        //     abort(403, 'Unauthorized action.');

        // Validasi input
        $validated = $request->validate([
            'isi' => 'required|string|min:3|max:1000',
        ]);

        // Buat komentar baru
        $comment = new Comment();
        $comment->isi = $validated['isi'];
        $comment->user_id = Auth::id(); // ID user yang login
        $comment->aspirasi_id = $aspirasi->id;

        // Simpan ke database
        $comment->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Menghapus komentar
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(string $comment_id)
    {
        // Cari komentar berdasarkan ID
        $comment = Comment::findOrFail($comment_id);
        // Hapus komentar
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}