<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //buatkan room insert 20 number 
        Room::insert([
            ['room_number' => '101', 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '102', 'created_at' => now(), 'updated_at' => now()],
            ['room_number' => '103', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
