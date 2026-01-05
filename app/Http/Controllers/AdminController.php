<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:access-admin']);
    }

    public function dashboard()
    {
        $totalBookings = Booking::count();
        $totalRevenue = Payment::where('status', 'settlement')->sum('amount');
        $roomsCount = Room::count();

        return view('admin.dashboard', compact('totalBookings', 'totalRevenue', 'roomsCount'));
    }
}
