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
        
    }

    public function store(Request $request)
    {
       
    }

    public function show($id)
    {
        return 'halaman profile ' . $id;
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
      
    }
}