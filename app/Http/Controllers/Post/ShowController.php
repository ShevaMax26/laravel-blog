<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $data = Carbon::parse($post->created_at);
        $relatedPosts = Post::where('category_id', $post->category->id)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('post.show', compact('post', 'data', 'relatedPosts'));
    }
}
