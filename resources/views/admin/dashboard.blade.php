@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Admin Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Rooms</div>
            <div class="text-xl font-bold">{{ $roomsCount }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Bookings</div>
            <div class="text-xl font-bold">{{ $totalBookings }}</div>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <div class="text-sm text-gray-500">Revenue</div>
            <div class="text-xl font-bold">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
        </div>
    </div>
@endsection
