<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Database\Seeders\VotesSeeder;
use Database\Seeders\FavoritesSeeder;
use Database\Seeders\QuestionsUsersAnswersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            QuestionsUsersAnswersSeeder::class,
            FavoritesSeeder::class,
            VotesSeeder::class
        ]);
        
        

    }
}
