<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Berita;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index() {
        $beritas = Berita::withCount('komentar')->with('penulis')->latest()->get();

        // Ambil berita dari API CNN Indonesia
        $cnnNews = [];
        $response = \Illuminate\Support\Facades\Http::get('https://api-berita-indonesia.vercel.app/cnn/terbaru');
        if ($response->successful()) {
            $cnnNews = $response->json()['data']['posts'] ?? [];
        }

        return view('home', compact('beritas', 'cnnNews'));
    }
}
