@extends('layouts.app')

@section('title', 'Reservations List')

@section('content')
    <div class="container">
        <h1>Reservations List</h1>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Date of Meeting</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Room Name</th>
                <th>Room Capacity</th>
                <th>Number of Attendees</th>
                <th>Meeting Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->date_of_meeting }}</td>
                    <td>{{ $reservation->start_time }}</td>
                    <td>{{ $reservation->end_time }}</td>
                    <td>{{ $reservation->room->name }}</td>
                    <td>{{ $reservation->room->capacity }}</td>
                    <td>{{ $reservation->number_of_attendees }}</td>
                    <td>{{ $reservation->meeting_status ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
