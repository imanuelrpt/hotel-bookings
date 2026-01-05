<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create(Booking $booking)
    {
        // show payment page (checkout)
        return view('bookings.checkout', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        // Note: requires midtrans/midtrans-php package and config/midtrans.php to be set

        $amount = $booking->total_price;

        // create local payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        try {
            // Use Midtrans Snap API (placeholder) - developer must install midtrans/midtrans-php
            // Simplified payment integration - replace with actual Midtrans integration
            $transactionId = 'ORDER-' . $payment->id . '-' . time();
            $snapToken = 'DUMMY-' . $transactionId; // In real app, get this from Midtrans API

            // Update payment with transaction ID
            $payment->update([
                'transaction_id' => $transactionId,
                'raw_response' => [
                    'snap_token' => $snapToken,
                    'order_id' => $transactionId,
                    'amount' => $amount
                ]
            ]);

            // Return the payment token
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Throwable $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment gateway error'], 500);
        }
    }

    // Webhook endpoint to be called by Midtrans
    public function webhook(Request $request)
    {
        $payload = $request->all();
        // TODO: validate signature with Midtrans
        // Find payment by order_id -> update status
        Log::info('Midtrans webhook', $payload);
        return response('OK');
    }

    // Upload proof of payment (manual bank transfer)
    public function uploadProof(Request $request, Booking $booking)
    {
        $request->validate([
            'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        // find or create a local payment record for this booking
        $payment = Payment::firstOrCreate(
            ['booking_id' => $booking->id],
            ['amount' => $booking->total_price, 'status' => 'pending']
        );

        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $path = $file->store('payments', 'public');

            $payment->update([
                'proof' => $path,
                'status' => 'waiting_confirmation',
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim.');
        }

        return redirect()->back()->with('error', 'File bukti tidak ditemukan.');
    }
}
