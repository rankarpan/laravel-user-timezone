<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Article;
use App\User;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $user_id = User::lists('id');

        $limit = 139;

        for ($i = 0; $i < $limit; $i++) {
            Article::insert([
                'title' => $faker->sentence(7),
                'body' => $faker->paragraph(3),
                'created_by' => $faker->numberBetween($min = 1, $max = 15)
            ]);
        }
    }
}
