<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'date_of_birth' => '1991-07-05',
                'gender' => 'male',
            ],
            [
                'name' => 'Company User',
                'email' => 'company@company.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'date_of_birth' => '1990-01-01',
                'gender' => 'female',
            ],
            [
                'name' => 'Staff User',
                'email' => 'staff@staff.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
            ],
        ]);
    }
}
