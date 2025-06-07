<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Himpunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan data user yang login

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource for regular users (mahasiswa).
     */
    public function index() {
        $aspirasi = Aspirasi::with(['himpunan', 'user'])->latest()->paginate(10);
        return view('aspirasi.index', compact('aspirasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Otorisasi: Hanya user terautentikasi yang bisa membuat aspirasi
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        $himpunans = Himpunan::all();
        return view('aspirasi.create', compact('himpunans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Otorisasi: Hanya user terautentikasi yang bisa membuat aspirasi
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'himpunan_id' => 'required|exists:himpunans,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        Aspirasi::create([
            'user_id' => Auth::id(),
            'mahasiswa_nim' => Auth::user()->nim,
            'mahasiswa_nama' => Auth::user()->nama_panjang,
            'himpunan_id' => $request->himpunan_id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'status' => 'pending', // Status awal saat aspirasi baru dibuat
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        // // Otorisasi: Hanya pemilik aspirasi yang bisa melihat detail
        // if (!Auth::check() || Auth::user()->id !== $aspirasi->user_id) {
        //     abort(403, 'Unauthorized action.');
        // }
        $aspirasi = $aspirasi->load(['himpunan', 'user', 'comments.user']); // Memuat relasi himpunan, user, dan komentar dengan user
        return view('aspirasi.show', compact('aspirasi'));

    }

}