<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// Tidak perlu import Validator secara eksplisit jika hanya menggunakan $request->validate()

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_panjang' => ['required', 'string', 'max:255'],
            'nama_panggilan' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nim' => ['required', 'string', 'max:20', 'unique:users,nim'],
            'fakultas' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        User::create([
            'nama_panjang' => $validated['nama_panjang'],
            'nama_panggilan' => $validated['nama_panggilan'] ?? null,
            'email' => $validated['email'],
            'nim' => $validated['nim'],
            'fakultas' => $validated['fakultas'],
            'jurusan' => $validated['jurusan'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}