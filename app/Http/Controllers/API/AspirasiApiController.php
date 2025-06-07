<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;

class AspirasiApiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::limit(15)->with(['himpunan','user'])->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $aspirasi->toArray(),
        ]);
    }
}