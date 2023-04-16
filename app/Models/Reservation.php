<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekday',
        'start_time',
        'end_time',
        'room_id',
        'number_of_attendees',
        'meeting_status',
    ];

    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    public function getStartTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getEndTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function getDifferenceAttribute()
    {
        return \Carbon\Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeCalendarByRoleOrClassId($query)
    {
        return $query->when(!request()->input('room_id'), function ($query) {
            $query->when(auth()->user()->company(), function ($query) {
                $query->where('company_id', auth()->user()->id);
            })
                ->when(auth()->user()->staff, function ($query) {
                    $query->where('room_id', auth()->user()->room_id ?? '0');
                });
        })
            ->when(request()->input('room_id'), function ($query) {
                $query->where('room_id', request()->input('room_id'));
            });
    }
}

