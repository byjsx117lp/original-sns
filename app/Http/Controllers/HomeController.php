<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    //
    public function index() {
        $posts = Post::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('home', ['posts' => $posts]);
    }
}
