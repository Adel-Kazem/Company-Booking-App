<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class RoomsTableSeeder extends Seeder
{
    public function run()
    {
        $company = Company::first();

        DB::table('rooms')->insert([
            [
                'company_id' => $company->id,
                'name' => 'Room A',
                'capacity' => 10,
                'room_description' => 'Conference room with projector',
                'location' => '1st Floor',
            ],
            [
                'company_id' => $company->id,
                'name' => 'Room B',
                'capacity' => 5,
                'room_description' => 'Small meeting room',
                'location' => '2nd Floor',
            ],
        ]);
    }
}
