<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => UserRole::ADMIN,
            'email' => 'admin@user.com',
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
        Category::factory()->count(2)->has(
            Product::factory()->count(10)->has(
                ProductDetails::factory()->count(3),
            )
        )->create();
    }
}
