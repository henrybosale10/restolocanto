<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'henry@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Client',
            'email' => 'clientheno@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'client', // rôle client
        ]);
    }
}
