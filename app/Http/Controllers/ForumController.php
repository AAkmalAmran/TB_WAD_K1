<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::latest()->get();
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
        $forum->increment('upvote');
        return back();
    }

    public function downvote(Forum $forum)
    {
        $forum->increment('downvote');
        return back();
    }
}

