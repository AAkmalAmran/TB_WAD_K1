<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //
    }

    
    public function edit(Article $article)
    {
        //
    }

    public function update(Request $request, Article $article)
    {
        //
    }

       
    

    public function destroy(Article $article)
    {
       //
    }

   
    public function show($id)
    {
        //
    }
}
