<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $reservations = [
            [
                'weekday' => 1,
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room_id' => 1,
                'number_of_attendees' => 10,
                'meeting_status' => true,
            ],
            [
                'weekday' => 2,
                'start_time' => '10:30',
                'end_time' => '12:30',
                'room_id' => 1,
                'number_of_attendees' => 20,
                'meeting_status' => false,
            ],
            [
                'weekday' => 3,
                'start_time' => '13:00',
                'end_time' => '15:00',
                'room_id' => 1,
                'number_of_attendees' => 30,
                'meeting_status' => true,
            ],
            [
                'weekday' => 4,
                'start_time' => '15:30',
                'end_time' => '17:30',
                'room_id' => 2,
                'number_of_attendees' => 40,
                'meeting_status' => false,
            ],
            [
                'weekday' => 5,
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room_id' => 2,
                'number_of_attendees' => 50,
                'meeting_status' => true,
            ],
        ];

            DB::table('reservations')->insert($reservations);

//        foreach ($reservations as $reservation) {
//            Reservation::create($reservation);
//        }
    }

//    public function run()
//    {
//        $reservations = [
//            [
//                'date_of_meeting' => Carbon::now()->addDays(1),
//                'start_time' => Carbon::now()->addDays(1)->addHours(10),
//                'end_time' => Carbon::now()->addDays(1)->addHours(12),
//                'room_id' => 1,
//                'number_of_attendees' => 20,
//                'meeting_status' => true,
//            ],
//            [
//                'date_of_meeting' => Carbon::now()->addDays(1),
//                'start_time' => Carbon::now()->addDays(1)->addHours(14),
//                'end_time' => Carbon::now()->addDays(1)->addHours(16),
//                'room_id' => 1,
//                'number_of_attendees' => 15,
//                'meeting_status' => true,
//            ],
//            [
//                'date_of_meeting' => Carbon::now()->addDays(1),
//                'start_time' => Carbon::now()->addDays(1)->addHours(10),
//                'end_time' => Carbon::now()->addDays(1)->addHours(12),
//                'room_id' => 2,
//                'number_of_attendees' => 25,
//                'meeting_status' => true,
//            ],
//            [
//                'date_of_meeting' => Carbon::now()->addDays(1),
//                'start_time' => Carbon::now()->addDays(1)->addHours(14),
//                'end_time' => Carbon::now()->addDays(1)->addHours(16),
//                'room_id' => 2,
//                'number_of_attendees' => 30,
//                'meeting_status' => true,
//            ],
//        ];
//
//        DB::table('reservations')->insert($reservations);
//    }
}
