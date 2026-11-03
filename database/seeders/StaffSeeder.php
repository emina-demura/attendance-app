<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // パスワードは "password"
            'role' => 'admin',
        ]);

    }
}
