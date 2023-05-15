<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $likedPosts = auth()->user()->likedPosts->count();
        $comments = auth()->user()->comments->count();

        return view('personal.main.index', compact('likedPosts', 'comments'));
    }
}
