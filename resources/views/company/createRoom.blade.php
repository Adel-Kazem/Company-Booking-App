@extends('layouts.app')

@section('title', 'Create Room')

@section('content')
    <div class="container">
        <h1>Create Room</h1>
        <form action="{{route('company.create.room.submit')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Capacity</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
            </div>
            <div class="mb-3">
                <label for="room_description" class="form-label">Room Description</label>
                <input type="text" class="form-control" id="room_description" name="room_description" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Room</button>
        </form>
    </div>
@endsection
