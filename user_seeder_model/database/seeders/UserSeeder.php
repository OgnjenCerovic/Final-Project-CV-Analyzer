<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Selena', 'last_name' => 'Gomez', 'email' => 'selena@example.com', 'status' => 'employer', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Emma', 'last_name' => 'Watson', 'email' => 'emma@example.com', 'status' => 'employee', 'password' => Hash::make('password'),]);
        User::create(['name' => 'Pera', 'last_name' => 'Peric', 'email' => 'pera@example.com', 'status' => 'employee', 'password' => Hash::make('password'),]);
    }
}
