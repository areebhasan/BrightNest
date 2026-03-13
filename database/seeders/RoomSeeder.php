<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'name' => 'Koala Room',
            'age_group' => '2 to 3 years',
            'status' => 'active',
        ]);

        Room::create([
            'name' => 'Kangaroo Room',
            'age_group' => '3 to 4 years',
            'status' => 'active',
        ]);

        Room::create([
            'name' => 'Joey Room',
            'age_group' => '1 to 2 years',
            'status' => 'active',
        ]);
    }
}