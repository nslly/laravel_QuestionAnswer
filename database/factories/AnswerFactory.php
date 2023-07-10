<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body'          => fake()->paragraphs(rand(5, 8), true),
            'user_id'       => User::pluck('id')->random(),
            'question_id'   => Question::pluck('id')->random(),
        ];
    }
}
