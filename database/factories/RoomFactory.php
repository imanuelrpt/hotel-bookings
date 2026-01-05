<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(300000, 2000000),
            'capacity' => $this->faker->numberBetween(1, 6),
            'type' => $this->faker->randomElement(['standard', 'deluxe', 'suite', 'family']),
            'features' => $this->faker->randomElements(['WiFi', 'AC', 'TV', 'Mini Bar', 'Room Service', 'Swimming Pool', 'Gym Access', 'Breakfast'], $this->faker->numberBetween(3, 6)),
            'images' => [$this->faker->imageUrl(800, 600, 'hotel')],
            'is_active' => true,
        ];
    }
}