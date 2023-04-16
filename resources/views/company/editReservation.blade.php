@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
    <div class="container">
        <h1>Edit Reservation</h1>
        <form action="/company/room/edit/reservation/{{ $reservation->id }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="date_of_meeting">Date of Meeting</label>
                <input type="datetime-local" name="date_of_meeting" id="date_of_meeting" class="form-control" value="{{ $reservation->date_of_meeting }}" required>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ $reservation->start_time }}" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ $reservation->end_time }}" required>
            </div>
            <div class="form-group">
                <label for="room_id">Related Room</label>
                <select name="room_id" id="room_id" class="form-control" required>
                    {{-- Add room options here, fetched from the Room model --}}
                </select>
            </div>
            <div class="form-group">
                <label for="number_of_attendees">Number of Attendees</label>
                <input type="number" name="number_of_attendees" id="number_of_attendees" class="form-control" value="{{ $reservation->number_of_attendees }}" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="meeting_status" id="meeting_status" class="form-check-input" {{ $reservation->meeting_status ? 'checked' : '' }}>
                <label class="form-check-label" for="meeting_status">Meeting Status</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Reservation</button>
        </form>
    </div>
@endsection