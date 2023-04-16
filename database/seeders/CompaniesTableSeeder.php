<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $companyUser = DB::table('users')->where('role', 'company')->first();

        DB::table('companies')->insert([
            'name' => 'Sample Company',
            'description' => 'Sample company description',
            'email' => 'company@example.com',
            'logo' => null,
            'active' => true,
            'user_id' => $companyUser->id,
        ]);
    }
}
