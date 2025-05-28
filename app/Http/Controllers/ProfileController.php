<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        return 'Halaman Profil';
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
       
    }

    
    public function edit()
    {
        
    }

    public function update(Request $request)
    {
        
    }


    public function destroy(Profile $profile)
    {
       
    }

 
    public function show($id)
    {
       
    }
}
