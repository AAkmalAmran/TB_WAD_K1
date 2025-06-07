<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Komentar;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::with('penulis')->orderBy('created_at', 'desc')->get();
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        \App\Models\Berita::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jumlah_komentar' => 0,
            'jumlah_view' => 0,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat.');
    }

    public function komentar($id)
    {
        $berita = \App\Models\Berita::with('penulis')->findOrFail($id);
        // Ambil komentar jika sudah ada relasi
        return view('berita.komentar', compact('berita'));
    }

    public function storeKomentar(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);
        Komentar::create([
            'berita_id' => $id,
            'user_id' => auth()->id(),
            'isi' => $request->komentar,
        ]);
        Berita::where('id', $id)->increment('jumlah_komentar');
        return redirect()->route('berita.komentar', $id)->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        // Hanya admin yang boleh edit
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);
        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403);
        }
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
