<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use App\Const\EventStatus;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::where('name', 'Conferencias')->first();
        $location = Location::where('name', 'Sala de Conferencias')->first();

        Event::create([
            'name' => 'Tech Talks 2025',
            'description' => 'Conferencia sobre las últimas tendencias en tecnología y desarrollo de software.',
            'event_start_date' => '2025-07-15 09:00:00',
            'event_end_date' => '2025-07-15 17:00:00',
            'status' => EventStatus::PUBLISHED,
            'available_places' => 200,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);

        $category = Category::where('name', 'Conciertos')->first();
        $location = Location::where('name', 'Sala de Conciertos')->first();

        Event::create([
            'name' => 'Festival de Jazz de Verano',
            'description' => 'Concierto al aire libre con las mejores bandas de jazz del país.',
            'event_start_date' => '2025-08-20 18:00:00',
            'event_end_date' => '2025-08-20 23:00:00',
            'status' => EventStatus::PUBLISHED,
            'available_places' => 500,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);

        $category = Category::where('name', 'Talleres')->first();
        $location = Location::where('name', 'Sala de Talleres')->first();

        Event::create([
            'name' => 'Workshop de Fotografía Urbana',
            'description' => 'Taller práctico para aprender técnicas de fotografía en espacios urbanos.',
            'event_start_date' => '2025-06-10 10:00:00',
            'event_end_date' => '2025-06-10 14:00:00',
            'status' => EventStatus::CANCELLED,
            'available_places' => 30,
            'category_id' => $category->id,
            'location_id' => $location->id,
        ]);
    }
}
