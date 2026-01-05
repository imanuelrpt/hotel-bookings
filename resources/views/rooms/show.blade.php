@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <img src="{{ $room->images[0] ?? 'https://via.placeholder.com/800x400' }}" alt="{{ $room->title }}" class="w-full h-64 object-cover rounded" />
            <h1 class="text-2xl font-semibold mt-4">{{ $room->title }}</h1>
            <p class="text-gray-600 mt-2">{{ $room->description }}</p>
            <div class="mt-4">
                <h3 class="font-semibold">Facilities</h3>
                <ul class="list-disc ml-5 text-sm text-gray-700">
                    @foreach($room->features ?? [] as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <aside class="bg-white p-4 rounded shadow">
            <div class="text-xl font-bold">Rp {{ number_format($room->price,0,',','.') }}</div>
            <div class="text-sm text-gray-600">Capacity: {{ $room->capacity }} persons</div>

            @auth
                <form method="POST" action="{{ route('bookings.store', $room->id) }}" class="mt-4">
                    @csrf
                    <label class="block text-sm">Check-in</label>
                    <input type="date" name="check_in" class="w-full border rounded px-2 py-1" required>
                    <label class="block text-sm mt-2">Check-out</label>
                    <input type="date" name="check_out" class="w-full border rounded px-2 py-1" required>
                    <label class="block text-sm mt-2">Guests</label>
                    <input type="number" name="guests" value="1" min="1" class="w-full border rounded px-2 py-1" required>
                    <button type="submit" class="w-full mt-3 bg-green-600 text-white py-2 rounded">Book Now</button>
                </form>
            @else
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="w-full inline-block text-center bg-blue-600 text-white py-2 rounded">Login to book</a>
                </div>
            @endauth
        </aside>
    </div>
@endsection
