<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('now', '+30 days');
        $checkOut = (clone $checkIn)->modify('+' . $this->faker->numberBetween(1, 7) . ' days');

        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => $this->faker->numberBetween(1, 4),
            'total_price' => $this->faker->numberBetween(500000, 3000000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}