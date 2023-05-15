<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Title' . $this->faker->words(rand(3, 7), true),
            'content' => $this->faker->paragraphs(rand(5, 10), true),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
