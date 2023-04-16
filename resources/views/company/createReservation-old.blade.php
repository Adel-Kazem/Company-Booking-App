@extends('layouts.app')

@section('title', 'Create Reservation')

@section('content')
    <div class="container">
        <h1>Create Reservation</h1>
        <form action="{{route('company.create.reservation.submit')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="date_of_meeting">Date of Meeting</label>
                <input type="datetime-local" name="date_of_meeting" id="date_of_meeting" class="form-control{{ $errors->has('date_of_meeting') ? ' is-invalid' : '' }}" value="{{ old('date_of_meeting') }}" required>
                @error('date_of_meeting')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" value="{{ old('start_time') }}" required>
                @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" value="{{ old('end_time') }}" required>
                @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="room_id">Related Room</label>
                <select name="room_id" id="room_id" class="form-control{{ $errors->has('room_id') ? ' is-invalid' : '' }}" required>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach

                </select>
                @error('room_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="number_of_attendees">Number of Attendees</label>
                <input type="number" name="number_of_attendees" id="number_of_attendees" class="form-control{{ $errors->has('number_of_attendees') ? ' is-invalid' : '' }}" value="{{ old('number_of_attendees') }}" required>
                @error('number_of_attendees')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="meeting_status" id="meeting_status" class="form-check-input" value="1" checked>
{{--                <input type="checkbox" name="meeting_status" id="meeting_status" class="form-check-input" value="true" {{ old('meeting_status') ? 'checked' : '' }}>--}}
                <label class="form-check-label" for="meeting_status">Meeting Status</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form>
    </div>
@endsection
