<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Factory as Faker;
use App\Models\City;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colombia = Country::create([
            'name' => 'Colombia',
        ]);
        $mexico = Country::create([
            'name' => 'México',
        ]);

        City::create([
            'name' => 'Ciudad de México',
            'country_id' => $mexico->id,
        ]);
        City::create([
            'name' => 'Bogotá',
            'country_id' => $colombia->id,
        ]);
    }
}
