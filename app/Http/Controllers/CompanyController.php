<?php

namespace App\Http\Controllers;

use App\Services\TimeService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function userEditForm()
    {
        $user = Auth::user();
        if ($user->role == 'company') {
            return view('company.userEdit', ['user' => $user]);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function userEditSubmit(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);
        return redirect('/')->with('success', 'User updated successfully.');
//        return redirect('/edit/user')->with('success', 'User updated successfully.');
    }

    public function companyEditForm()
    {
        $user = Auth::user();
        if ($user->role == 'company') {
            $company = $user->company;
            return view('company.companyEdit', ['company' => $company]);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function companyEditSubmit(Request $request)
    {
        $user = Auth::user();
        $company = $user->company;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'logo' => 'nullable|image',
            'active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Store the logo and get the path
            $path = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $path;
        }

        $company->update($validatedData);
        return redirect('/')->with('success', 'User updated successfully.');
//        return redirect('/edit')->with('success', 'Company updated successfully.');
    }


    public function createRoomForm()
    {
        return view('company.createRoom');
    }

    public function createRoomSubmit(Request $request)
    {
        $user = Auth::user();

        if ($user->role != 'company') {
            return abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'room_description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $room = new Room($validatedData);
        $user->company->rooms()->save($room);

        return redirect('/company/create/room')->with('success', 'Room created successfully.');
    }

    public function showRooms()
    {
        $user = Auth::user();

        if ($user->role != 'company') {
            return abort(403, 'Unauthorized action.');
        }

        $rooms = $user->company->rooms;

        return view('company.showRooms', ['rooms' => $rooms]);
    }

    public function createReservationForm()
    {
        $user = Auth::user();
        $rooms = $user->company->rooms;

        return view('company.createReservation', compact('rooms'));
    }

    public function createReservationSubmit(Request $request)
    {
        $request->validate([
            'weekday' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_id' => 'required|exists:rooms,id',
            'number_of_attendees' => 'required|integer|min:1',
            'meeting_status' => 'boolean',
        ]);

        $weekday = $request->input('weekday');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $room_id = $request->input('room_id');
        $number_of_attendees = $request->input('number_of_attendees');

        $room = Room::find($room_id);

        if ($room->capacity < $number_of_attendees) {
            return redirect()->back()->with('error', 'The number of attendees exceeds the room capacity.')->withInput();
        }

        // Check for overlapping reservations
        $overlappingReservations = Reservation::where('weekday', $weekday)
            ->where('room_id', $room_id)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time])
                    ->orWhere(function ($query) use ($start_time, $end_time) {
                        $query->where('start_time', '<', $start_time)
                            ->where('end_time', '>', $end_time);
                    });
            })
            ->exists();

        if ($overlappingReservations) {
            return redirect()->back()->with('error', 'The reservation overlaps with an existing reservation.')->withInput();
        }

        $meeting_status = $request->has('meeting_status') ? 1 : 0;

        $reservation = new Reservation([
            'weekday' => $weekday,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'room_id' => $room_id,
            'number_of_attendees' => $number_of_attendees,
            'meeting_status' => $meeting_status,
        ]);

        $reservation->save();

        return redirect('/company/room/create/reservation')->with('success', 'Reservation created successfully.');
    }

    public function createReservationSubmitOld(Request $request)
    {
        $user = Auth::user();
//        $company = $user->company;

        $validatedData = $request->validate([
            'date_of_meeting' => 'required|date',
            'start_time' => 'required|date_format:Y-m-d\TH:i|after_or_equal:date_of_meeting',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time|after_or_equal:date_of_meeting',
            'room_id' => 'required|exists:rooms,id',
            'number_of_attendees' => 'required|integer|min:1',
            'meeting_status' => 'boolean',
        ]);

        $validatedData['meeting_status'] = $request->has('meeting_status');
        $room = Room::firstWhere('id', $validatedData['room_id']);

        if (!$room) {
            return redirect()->back()->with('message', 'Invalid room ID');
        }

        if ($validatedData['number_of_attendees'] > $room->capacity) {
            return redirect()->back()->with('message', 'Number of attendees exceeds room capacity');
        }

        $reservation = new Reservation([
            'date_of_meeting' => $validatedData['date_of_meeting'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'room_id' => $validatedData['room_id'],
            'number_of_attendees' => $validatedData['number_of_attendees'],
            'meeting_status' => $validatedData['meeting_status'],
        ]);

        $reservation->save();

        return redirect('/company/room/create/reservation')->with('success', 'Reservation created successfully.');
    }

    public function showReservations()
    {
        $user = Auth::user();

        if ($user->role != 'company') {
            return abort(403, 'Unauthorized action.');
        }

//        $reservations = $user->company->rooms->reservations;
        $reservations = $user->company->rooms->flatMap(function ($room) {
            return $room->reservations;
        });


        return view('company.showReservations3', ['reservations' => $reservations]);
    }

    public function showReservations2()
    {
        $user = Auth::user();

        if ($user->role != 'company') {
            return abort(403, 'Unauthorized action.');
        }

//        $reservations = $user->company->rooms->reservations;
        $reservations = $user->company->rooms->flatMap(function ($room) {
            return $room->reservations;
        });


        return view('company.showReservations3', ['reservations' => $reservations]);
    }

    public function generateCalendarData()
    {
        $weekDays     =  Reservation::WEEK_DAYS;

        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $reservations   = Reservation::with('room', 'room.company')
//            ->calendarByRoleOrClassId()
            ->get();

        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $reservation = $reservations->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($reservation)
                {
                    array_push($calendarData[$timeText], [
                        'room_name'   => $reservation->room->name,
                        'company_name' => $reservation->room->company->name,
                        'rowspan'      => $reservation->difference/30 ?? ''
                    ]);
                }
                else if (!$reservations->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

         $calendarData;
        return view('company.showReservations4', compact('calendarData', 'weekDays'));
    }

    public function getDayOfWeekNumber($dateString)
    {
        $carbonDate = \Carbon\Carbon::parse($dateString);
        $dayOfWeek = $carbonDate->dayOfWeek;

        // Map the Carbon dayOfWeek value to a number from 1 to 7
        $dayOfWeekNumber = $dayOfWeek == 0 ? 7 : $dayOfWeek;

        return $dayOfWeekNumber;
    }



}
