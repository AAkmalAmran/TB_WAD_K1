<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Fakultas;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        $jurusans = \App\Models\Jurusan::all();
        $fakultas = \App\Models\Fakultas::all();
        return view('profile.edit', compact('user', 'jurusans', 'fakultas'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_panjang' => 'required',
            'nama_panggilan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // foto opsional
            // password opsional
            
        ]);
        
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/foto');
            $validated['foto'] = str_replace('public/', '', $fotoPath); // Simpan path relatif
        } else {
            unset($validated['foto']);
        }


        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diupdate');
    }


}