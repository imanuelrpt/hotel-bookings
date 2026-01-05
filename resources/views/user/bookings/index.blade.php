@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">My Bookings</h1>
    <div class="space-y-4">
        @foreach($bookings as $b)
            <div class="bg-white p-4 rounded shadow">
                <div class="flex justify-between">
                    <div>
                        <div class="font-semibold">{{ $b->room->title }}</div>
                        <div class="text-sm text-gray-600">{{ $b->check_in->format('Y-m-d') }} — {{ $b->check_out->format('Y-m-d') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold">Rp {{ number_format($b->total_price,0,',','.') }}</div>
                        <div class="text-sm text-gray-600">{{ ucfirst($b->status) }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">{{ $bookings->links() }}</div>
@endsection
