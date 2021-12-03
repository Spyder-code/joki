<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'role_id' => 1,
            'email' => 'admin@yahoo.com',
            'password' => Hash::make('admin123'),
            'avatar' => 'default.jpg',
            'phone' => '083857317946',
        ]);

        User::create([
            'name' => 'Freelance 01',
            'username' => 'freelance',
            'role_id' => 2,
            'email' => 'freelance@yahoo.com',
            'password' => Hash::make('freelance123'),
            'avatar' => 'default.jpg',
            'phone' => '083857317946',
        ]);

        User::create([
            'name' => 'User 01',
            'username' => 'user',
            'role_id' => 3,
            'email' => 'user@yahoo.com',
            'password' => Hash::make('user123'),
            'avatar' => 'default.jpg',
            'phone' => '083857317946',
        ]);
    }
}
