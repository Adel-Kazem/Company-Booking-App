@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="/company/edit/room/{{ $room->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $room->name }}" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $room->capacity }}" required>
            </div>
            <div class="form-group">
                <label for="room_description">Room Description</label>
                <input type="text" name="room_description" id="room_description" class="form-control" value="{{ $room->room_description }}" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $room->location }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>
@endsection
