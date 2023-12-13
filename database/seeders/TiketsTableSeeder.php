<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TiketsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil semua film IDs dari tabel films
        $filmIds = DB::table('films')->pluck('id')->toArray();

        // Buat data dummy untuk tikets
        foreach (range(1, 10) as $index) {
            DB::table('tikets')->insert([
                'waktu' => $faker->time,
                'tanggal_pemesanan' => $faker->date,
                'row_kursi' => $faker->randomLetter,
                'seat_kursi' => $faker->numberBetween(1, 10),
                'harga' => $faker->randomFloat(2, 50000, 150000),
                'film_id' => $faker->randomElement($filmIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
