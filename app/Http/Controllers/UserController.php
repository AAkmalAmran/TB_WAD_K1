<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan daftar mahasiswa
    public function index()
    {
        $users = User::where('role', 'mahasiswa')->get();
        return view('admin.users.index', compact('users'));
    }

    // Tampilkan detail profil mahasiswa
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Hapus user
    public function destroy(User $user)
    {
        // Hapus foto profil jika ada
        if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
            \Storage::disk('public')->delete($user->foto);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}