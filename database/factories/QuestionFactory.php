<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'     => rtrim(fake()->sentence(rand(5, 10)), '.'),
            'body'      => fake()->paragraphs(rand(3, 7), true), 
            'views'     => $this->faker->randomNumber(5),
            // 'answers'   => $this->faker->randomNumber(5),
            'user_id'   => User::factory(),
        ];
    }
}
