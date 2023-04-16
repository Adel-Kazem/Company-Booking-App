@extends('layouts.app')

@section('title', 'Timeline')

@section('content')
    <div class="container">
        <h1>Timeline</h1>
        <div id="timeline">
            <ul id="dates">
                @foreach ($reservations as $reservation)
                    <li><a href="#">{{ $reservation->date_of_meeting }}</a></li>
                @endforeach
            </ul>
            <ul id="issues">
                @foreach ($reservations as $reservation)
                    <li id="{{ $reservation->id }}">
                        <h3>{{ $reservation->room->name }}</h3>
                        <p>Start Time: {{ $reservation->start_time }}</p>
                        <p>End Time: {{ $reservation->end_time }}</p>
                        <p>Room Capacity: {{ $reservation->room->capacity }}</p>
                        <p>Number of Attendees: {{ $reservation->number_of_attendees }}</p>
                        <p>Meeting Status: {{ $reservation->meeting_status ? 'Active' : 'Inactive' }}</p>
                    </li>
                @endforeach
            </ul>
            <div id="graduation"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#timeline").timelinr();
        });
    </script>
@endsection
