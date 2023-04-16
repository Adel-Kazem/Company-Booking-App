@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th class="text-center">#</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Description</th>
            <th>Location</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $room)
            <tr>
                <td class="text-center">{{ $room->id }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->room_description }}</td>
                <td>{{ $room->location }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
