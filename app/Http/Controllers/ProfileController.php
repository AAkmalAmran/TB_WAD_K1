<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nama_panjang' => 'required',
            'nama_panggilan' => 'required',
            'nim' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
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

    public function delete()
    {
        $user = auth()->user();
        return view('profile.delete', compact('user'));
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->delete();
        auth()->logout();
        return redirect('/')->with('success', 'Akun berhasil dihapus');
    }
}