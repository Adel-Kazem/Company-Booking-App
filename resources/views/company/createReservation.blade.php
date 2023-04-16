@extends('layouts.app')

@section('title', 'Create Reservation')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Add Reservation
                    </div>
                    <div class="card-body">
                        <form action="{{route('company.create.reservation.submit')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="weekday">Weekday</label>
                                <select class="form-control" id="weekday" name="weekday">
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>
                                    <option value="7">Sunday</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>

                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>

                            <div class="form-group">
                                <label for="room_id">Room</label>
                                <select class="form-control" id="room_id" name="room_id" required>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="number_of_attendees">Number of Attendees</label>
                                <input type="number" class="form-control" id="number_of_attendees" name="number_of_attendees" required>
                            </div>

                            <div class="form-group">
                                <label for="meeting_status">Meeting Status</label>
                                <input type="checkbox" id="meeting_status" name="meeting_status" value="1">
                            </div>

                            <button type="submit" class="btn btn-primary">Add Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#start_time').on('change', function() {
                let time = $(this).val();
                let timeParts = time.split(':');
                let hours = parseInt(timeParts[0]);
                let minutes = parseInt(timeParts[1]);

                if (minutes < 15) {
                    minutes = 0;
                } else if (minutes < 45) {
                    minutes = 30;
                } else {
                    minutes = 0;
                    hours = (hours + 1) % 24;
                }

                let roundedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);
                $(this).val(roundedTime);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#end_time').on('change', function() {
                let time = $(this).val();
                let timeParts = time.split(':');
                let hours = parseInt(timeParts[0]);
                let minutes = parseInt(timeParts[1]);

                if (minutes < 15) {
                    minutes = 0;
                } else if (minutes < 45) {
                    minutes = 30;
                } else {
                    minutes = 0;
                    hours = (hours + 1) % 24;
                }

                let roundedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);
                $(this).val(roundedTime);
            });
        });
    </script>
@endsection