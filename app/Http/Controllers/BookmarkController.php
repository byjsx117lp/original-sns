<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class BookmarkController extends Controller
{
    //
    public function index($user_id) {
        $posts = Post::select('posts.*')
            ->join('bookmarks', 'bookmarks.post_id', '=', 'posts.id')
            ->where('bookmarks.user_id', $user_id)
            ->orderBy('bookmarks.created_at', 'desc')
            ->paginate(10);

        return view('bookmarks.index',['posts' => $posts]);
    }

    public function store($post) {
        Auth::user()->add_bookmark($post);
        return back();
    }

    public function destroy($post) {
        Auth::user()->take_bookmark($post);
        return back();
    }
}
