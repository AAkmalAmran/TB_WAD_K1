<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return 'halaman profile';
    }


    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_panjang' => 'required',
            'nama_panggilan' => 'required',
            'email' => 'required|email|unique:users',
            'nim' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('profile.index')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)
    {
        $profile = User::findOrFail($id);
        return view('profile.show', compact('profile'));
    }

    public function edit($id)
    {
        $profile = User::findOrFail($id);
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = User::findOrFail($id);

        $validated = $request->validate([
            'nama_panjang' => 'required',
            'nama_panggilan' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'nim' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'role' => 'required',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $profile = User::findOrFail($id);
        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'User berhasil dihapus');
    }
}