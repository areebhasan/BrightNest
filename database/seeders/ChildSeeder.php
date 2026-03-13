<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;

class ChildSeeder extends Seeder
{
    public function run(): void
    {
        Child::create([
            'first_name' => 'Liam',
            'last_name' => 'Smith',
            'dob' => '2020-05-10',
            'room_name' => 'Koala Room',
            'status' => 'active'
        ]);

        Child::create([
            'first_name' => 'Emma',
            'last_name' => 'Brown',
            'dob' => '2021-02-15',
            'room_name' => 'Kangaroo Room',
            'status' => 'active'
        ]);

        Child::create([
            'first_name' => 'Noah',
            'last_name' => 'Johnson',
            'dob' => '2019-11-03',
            'room_name' => 'Koala Room',
            'status' => 'active'
        ]);
    }
}