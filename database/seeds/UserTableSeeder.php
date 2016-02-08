<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $limit = 15;

        for ($i = 0; $i < $limit; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make($faker->password)
            ]);
        }
    }
}