<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $fakultas = Fakultas::all();
        $jurusans = Jurusan::all();
        return view('auth.register', compact('fakultas', 'jurusans'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_panjang' => ['required', 'string', 'max:255'],
            'nama_panggilan' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nim' => ['required', 'string', 'max:20', 'unique:users,nim'],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
            'jurusan_id' => ['required', 'exists:jurusans,id'],
            'password' => ['required', 'min:6', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        User::create([
            'nama_panjang' => $validated['nama_panjang'],
            'nama_panggilan' => $validated['nama_panggilan'] ?? null,
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'fakultas_id' => $validated['fakultas_id'],
            'jurusan_id' => $validated['jurusan_id'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}