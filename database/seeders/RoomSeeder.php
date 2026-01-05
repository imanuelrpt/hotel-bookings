<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'title' => 'Deluxe Double Room',
                'slug' => 'deluxe-double-room',
                'description' => 'Comfortable double room with city view.',
                'price' => 450000,
                'capacity' => 2,
                'type' => 'deluxe',
                'amenities' => ['WiFi', 'TV', 'Air Conditioning'],
                'images' => ['https://via.placeholder.com/800x400?text=Deluxe+Double'],
                'is_active' => true,
            ],
            [
                'title' => 'Family Suite',
                'slug' => 'family-suite',
                'description' => 'Spacious suite suitable for families.',
                'price' => 850000,
                'capacity' => 4,
                'type' => 'suite',
                'amenities' => ['WiFi', 'TV', 'Mini Bar', 'Air Conditioning', 'Balcony', 'Bathtub'],
                'images' => ['https://via.placeholder.com/800x400?text=Family+Suite'],
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $r) {
            Room::updateOrCreate(['slug' => $r['slug']], $r);
        }
    }
}
