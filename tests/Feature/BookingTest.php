<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_rooms()
    {
        $room = Room::factory()->create();

        $response = $this->get('/rooms');

        $response->assertStatus(200)
            ->assertViewIs('rooms.index')
            ->assertSee($room->title);
    }

    public function test_user_can_view_room_details()
    {
        $room = Room::factory()->create();

        $response = $this->get("/rooms/{$room->slug}");

        $response->assertStatus(200)
            ->assertViewIs('rooms.show')
            ->assertSee($room->title)
            ->assertSee($room->description);
    }

    public function test_authenticated_user_can_book_room()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $response = $this->actingAs($user)
            ->post("/rooms/{$room->id}/book", [
                'check_in' => now()->addDays(1)->format('Y-m-d'),
                'check_out' => now()->addDays(3)->format('Y-m-d'),
                'guests' => 2
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);
    }

    public function test_guest_cannot_book_room()
    {
        $room = Room::factory()->create();

        $response = $this->post("/rooms/{$room->id}/book", [
            'check_in' => now()->addDays(1)->format('Y-m-d'),
            'check_out' => now()->addDays(3)->format('Y-m-d'),
            'guests' => 2
        ]);

        $response->assertRedirect('/login');
    }

    public function test_user_can_view_own_bookings()
    {
        $user = User::factory()->create();
        $booking = Booking::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->get('/bookings');

        $response->assertStatus(200)
            ->assertViewIs('user.bookings.index')
            ->assertSee($booking->room->title);
    }
}