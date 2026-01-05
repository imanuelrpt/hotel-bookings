<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $checkIn = \Carbon\Carbon::parse($data['check_in']);
        $checkOut = \Carbon\Carbon::parse($data['check_out']);
        $nights = $checkIn->diffInDays($checkOut);

        $total = $room->price * max(1, $nights);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests' => $data['guests'],
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // redirect to checkout
        return redirect()->route('bookings.checkout', $booking->id);
    }

    public function checkout(Booking $booking)
    {
        // simple ownership check
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.checkout', compact('booking'));
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }
}
