<?php

namespace Database\Factories;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'slug' => fake()->slug,
            'excerpt' => fake()->sentences(4, true),
            'body' => fake()->text(500),
            'status' => collect(Status::names())->random(),
            'published_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
