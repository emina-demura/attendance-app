<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            ['id' => 1, 'event_type' => '勤務外'],
            ['id' => 2, 'event_type' => '出勤中'],
            ['id' => 3, 'event_type' => '休憩中'],
            ['id' => 4, 'event_type' => '退勤済'],
        ]);
    }
}
