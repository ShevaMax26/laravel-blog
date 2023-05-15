<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store(array $data): void
    {
        $data['preview_image'] = Storage::disk('public')->put('images', $data['preview_image']);
        $data['main_image'] = Storage::disk('public')->put('images', $data['main_image']);

        $post = Post::create($data);

        if (isset($data['tag_ids'])) {
            $post->tags()->attach($data['tag_ids']);
        }
    }

    public function update(array $data, Post $post): Post
    {
        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('images', $data['preview_image']);
        }
        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::disk('public')->put('images', $data['main_image']);
        }

        $post->update($data);

        $post->tags()->sync($data['tag_ids'] ?? []);

        return $post;
    }

}
