<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'role' => UserRole::ADMIN,
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'phone' => '88005553535'
        ]);
        User::factory()->create([
            'role' => UserRole::USER,
            'email' => 'user@user.com',
            'name' => 'User',
            'password' => Hash::make('password'),
            'phone' => '89000000000'
        ]);
    }
}
