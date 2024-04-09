<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{

    public function store()
    {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();
        return view('index', ['posts' => $posts]);
    }
}
