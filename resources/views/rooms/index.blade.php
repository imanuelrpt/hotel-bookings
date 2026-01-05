@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Available Rooms</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ $room->images[0] ?? 'https://via.placeholder.com/400x250' }}" alt="{{ $room->title }}" class="w-full h-48 object-cover rounded" />
                <h2 class="mt-3 font-semibold">{{ $room->title }}</h2>
                <p class="text-sm text-gray-600">{{ Str::limit($room->description, 120) }}</p>
                <div class="flex justify-between items-center mt-3">
                    <div class="text-lg font-bold">Rp {{ number_format($room->price, 0, ',', '.') }}</div>
                    <a href="{{ route('rooms.show', $room->slug) }}" class="bg-blue-600 text-white px-3 py-1 rounded">View</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $rooms->links() }}
    </div>
@endsection
