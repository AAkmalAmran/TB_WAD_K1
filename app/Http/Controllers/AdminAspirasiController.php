<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Himpunan; // Asumsi ada model Himpunan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan data user yang login
use Illuminate\Support\Facades\Gate; // Untuk otorisasi (tidak digunakan langsung untuk pengecekan role di sini)

class AdminAspirasiController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     */
    public function index()
    {
        // Middleware di route sudah memastikan user adalah admin
        $aspirasi = Aspirasi::with('himpunan')->latest()->paginate(10);
        return view('admin.aspirasi.index', compact('aspirasi'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        // Middleware di route sudah memastikan user adalah admin
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspirasi $aspirasi)
    {
        // Middleware di route sudah memastikan user adalah admin
        $himpunans = Himpunan::all();
        return view('admin.aspirasi.edit', compact('aspirasi', 'himpunans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspirasi $aspirasi)
    {
        // Middleware di route sudah memastikan user adalah admin
        $request->validate([
            'himpunan_id' => 'required|exists:himpunans,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:pending,diproses,diterima,ditolak',
        ]);

        $aspirasi->update($request->all());

        return redirect()->route('admin.aspirasi.index')->with('success', 'Aspirasi berhasil diperbarui!');
    }

    /**
     * Mengupdate status aspirasi.
     */
    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        // Middleware di route sudah memastikan user adalah admin
        $request->validate([
            'status' => 'required|in:pending,diproses,diterima,ditolak',
        ]);

        $aspirasi->status = $request->status;
        $aspirasi->save();

        return redirect()->route('admin.aspirasi.index')->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspirasi $aspirasi)
    {
        // Middleware di route sudah memastikan user adalah admin
        $aspirasi->delete();

        return redirect()->route('admin.aspirasi.index')->with('success', 'Aspirasi berhasil dihapus!');
    }
}