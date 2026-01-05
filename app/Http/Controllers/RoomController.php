<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query()->where('is_active', true);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $rooms = $query->paginate(12);

        return view('rooms.index', [
            'rooms' => $rooms,
            'request' => $request
        ]);
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }
}
