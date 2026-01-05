<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'room'])
            ->latest()
            ->paginate(10);
            
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking status updated successfully.');
    }

    // Export bookings as CSV spreadsheet
    public function export(Request $request)
    {
        $bookings = Booking::with(['user', 'room'])->latest()->get();

        $filename = 'bookings-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = [
            'ID', 'User Name', 'User Email', 'Room', 'Check In', 'Check Out', 'Guests', 'Total Price', 'Status', 'Created At'
        ];

        $callback = function () use ($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $b) {
                fputcsv($file, [
                    $b->id,
                    $b->user->name ?? '',
                    $b->user->email ?? '',
                    $b->room->title ?? '',
                    $b->check_in->format('Y-m-d'),
                    $b->check_out->format('Y-m-d'),
                    $b->guests,
                    number_format($b->total_price, 2, '.', ''),
                    $b->status,
                    $b->created_at->toDateTimeString(),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}