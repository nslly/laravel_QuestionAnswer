<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->all();
        $countUsers = count($users);

        foreach (Question::all() as $question) 
        {
            for ($i = 0; $i < rand(1, $countUsers); $i++) {
                $user = $users[$i];
                $question->favorites()->attach($user);

            }
        }
    }
}
