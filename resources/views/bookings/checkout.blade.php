@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold">Checkout</h2>
        <div class="mt-4">
            <p><strong>Room:</strong> {{ $booking->room->title }}</p>
            <p><strong>Dates:</strong> {{ $booking->check_in->format('Y-m-d') }} — {{ $booking->check_out->format('Y-m-d') }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($booking->total_price,0,',','.') }}</p>
        </div>

        <div class="mt-4">
            <button id="pay-button" class="bg-blue-600 text-white px-4 py-2 rounded">Pay with Midtrans</button>
        </div>

        @if(session('success'))
            <div class="mt-4 text-green-700">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mt-4 text-red-700">{{ session('error') }}</div>
        @endif

        <div class="mt-4">
            <form method="POST" action="{{ route('payments.upload_proof', $booking) }}" enctype="multipart/form-data">
                @csrf
                <label class="block mb-2">Upload Bukti Pembayaran (jpg, png, pdf)</label>
                <input type="file" name="proof" accept="image/*,.pdf" required class="mb-2">
                <div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Kirim Bukti Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            fetch("{{ route('payments.process', $booking->id) }}", { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(r => r.json())
                .then(res => {
                    if (res.snap_token) {
                        window.snap.pay(res.snap_token, {
                            onSuccess: function(result){ window.location = '/'; },
                            onPending: function(result){ window.location = '/'; },
                            onError: function(result){ alert('Payment error'); }
                        });
                    }
                });
        });
    </script>
@endsection
