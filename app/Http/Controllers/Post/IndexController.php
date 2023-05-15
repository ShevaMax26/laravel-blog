<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::whereNotNull('preview_image')->inRandomOrder(6)->get();
        $likedPosts = Post::whereNotNull('preview_image')->withCount('likedUsers')->orderBy('liked_users_count', 'desc')->take(4)->get();

        return view('main.index', compact('posts', 'randomPosts', 'likedPosts'));
    }
}
