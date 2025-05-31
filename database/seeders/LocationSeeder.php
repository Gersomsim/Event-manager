<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\City;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = City::where('name', 'Ciudad de México')->first();
        Location::create([
            'name' => 'Sala de Conferencias',
            'description' => 'Sala de conferencias para eventos',
            'address' => 'Calle 123, Ciudad',
            'city_id' => $city->id,
        ]);

        Location::create([
            'name' => 'Sala de Conciertos',
            'description' => 'Sala de conciertos para eventos',
            'address' => 'Calle 123, Ciudad',
            'city_id' => $city->id,
        ]);
        $city = City::where('name', 'Bogotá')->first();
        Location::create([
            'name' => 'Sala de Talleres',
            'description' => 'Sala de talleres para eventos',
            'address' => 'Calle 123, Ciudad',
            'city_id' => $city->id,
        ]);
    }
}
