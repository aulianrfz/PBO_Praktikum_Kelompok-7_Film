<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) {
            DB::table('films')->insert([
                'judulFilm' => $faker->sentence,
                'rilis' => $faker->date,
                'genre' => $faker->word,
                'rating' => $faker->randomFloat(1, 1, 10),
                'deskripsi' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
