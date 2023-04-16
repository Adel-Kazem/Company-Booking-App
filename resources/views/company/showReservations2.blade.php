@extends('layouts.app')

@section('title', 'Timeline')

@section('css')
    <style>
        .timeline-item {
            position: relative;
            padding-bottom: 30px;
        }

        .timeline-connector {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: #ccc;
            z-index: -1;
        }

        .timeline-item:last-child .timeline-connector {
            display: none;
        }

        .card {
            position: relative;
            z-index: 1;
            margin-bottom: 30px;
        }
    </style>

@endsection

@section('content')
    <div class="container">
        <h1>Timeline</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @foreach ($reservations as $reservation)
                    <div class="timeline-item">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ $reservation->date_of_meeting }} - {{ $reservation->room->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p>Start Time: {{ $reservation->start_time }}</p>
                                <p>End Time: {{ $reservation->end_time }}</p>
                                <p>Room Capacity: {{ $reservation->room->capacity }}</p>
                                <p>Number of Attendees: {{ $reservation->number_of_attendees }}</p>
                                <p>Meeting Status: {{ $reservation->meeting_status ? 'Active' : 'Inactive' }}</p>
                            </div>
                        </div>
                        <div class="timeline-connector"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
