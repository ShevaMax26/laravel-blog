<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
//            UserSeeder::class,
        ]);
        $tags = Tag::factory(10)->create();
        $posts = Post::factory(50)->create();
        $users = User::factory(50)->create();

        foreach ($posts as $post) {
            $tagsIds = $tags->random(rand(1, 6))->pluck('id');
            $post->tags()->attach($tagsIds);

            $usersIds = $users->random(rand(10, 50))->pluck('id');
            $post->likedUsers()->attach($usersIds);

            $commentsCount = rand(1, 10);
            $commentedUsers = $users->random($commentsCount);

            for ($i = 0; $i < $commentsCount; $i++) {
                Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $commentedUsers[$i]->id,
                ]);
            }
        }
    }
}
