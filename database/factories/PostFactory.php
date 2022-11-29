<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'board_id' => \App\Models\Board::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }

    /**
     * Indicate that the post is an OP.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
     */
    public function op()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_op' => true,
            ];
        });
    }
}
