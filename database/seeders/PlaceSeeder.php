<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 30; $i++) {
            Place::create([
                'name' => $faker->word . " Place",
                'map_disc' => $faker->sentence,
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'rating' => $faker->randomFloat(1, 0, 5), // Random rating between 0 and 5
                'status' => 'مفتوح',
                'open_at' => '10:00:00',
                'close_at' => '03:00:00',
                'category_id' => 1,
            ]);
        }
    }
}
