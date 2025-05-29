<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Himpunan; // Asumsi ada model Himpunan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan data user yang login

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua aspirasi, bisa difilter per himpunan
        $aspirasi = Aspirasi::with('himpunan')->latest()->paginate(10);
        return view('aspirasi.index', compact('aspirasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat aspirasi baru
        $himpunans = Himpunan::all(); // Ambil semua himpunan untuk dropdown
        return view('aspirasi.create', compact('himpunans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'himpunan_id' => 'required|exists:himpunans,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        // Simpan aspirasi baru
        Aspirasi::create([
            'mahasiswa_nim' => Auth::user()->nim, // Ambil dari user yang login
            'mahasiswa_nama' => Auth::user()->name, // Ambil dari user yang login
            'himpunan_id' => $request->himpunan_id,
            'judul' => $request->judul,
            'konten' => $request->konten,
            'status' => 'pending', // Status awal
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        // Menampilkan detail aspirasi
        return view('aspirasi.show', compact('aspirasi'));
    }

    // Anda bisa menambahkan method lain seperti edit, update, destroy jika diperlukan
}