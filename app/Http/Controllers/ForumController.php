<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\ForumVote;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::orderBy('upvote', 'desc')->get();
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'nullable|string',
        ]);

        Forum::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forum.index')->with('success', 'Topik berhasil ditambahkan!');
    }

    public function upvote(Forum $forum)
    {
        $user = Auth::user();
        $vote = ForumVote::where('user_id', $user->id)->where('forum_id', $forum->id)->first();

        if ($vote) {
            if ($vote->type === 'upvote') {
                return back()->with('error', 'Anda sudah memberikan upvote.');
            } else {
                $forum->increment('upvote');
                $forum->decrement('downvote');
                $vote->update(['type' => 'upvote']);
                return back();
            }
        }

        ForumVote::create([
            'user_id' => $user->id,
            'forum_id' => $forum->id,
            'type' => 'upvote'
        ]);
        $forum->increment('upvote');
        return back();
    }

    public function downvote(Forum $forum)
    {
        $user = Auth::user();
        $vote = ForumVote::where('user_id', $user->id)->where('forum_id', $forum->id)->first();

        if ($vote) {
            if ($vote->type === 'downvote') {
                return back()->with('error', 'Anda sudah memberikan downvote.');
            } else {
                $forum->increment('downvote');
                $forum->decrement('upvote');
                $vote->update(['type' => 'downvote']);
                return back();
            }
        }

        ForumVote::create([
            'user_id' => $user->id,
            'forum_id' => $forum->id,
            'type' => 'downvote'
        ]);
        $forum->increment('downvote');
        return back();
    }

    // ✅ Fungsi hapus topik (dengan verifikasi user)
    public function destroy(Forum $forum)
    {
        if (Auth::id() !== $forum->user_id) {
            return redirect()->route('forum.index')->with('error', 'Kamu tidak punya izin untuk menghapus topik ini.');
        }

        $forum->delete();
        return redirect()->route('forum.index')->with('success', 'Topik berhasil dihapus.');
    }
}
