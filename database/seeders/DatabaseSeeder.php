<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'Polaris',
            'email' => 'polaris@seller.com',
            'password' => bcrypt('12341234'),
            'phone' => '081234567890',
            'address' => 'Jl. Polaris No. 1',
            'country' => 'Indonesia',
            'province' => 'DKI Jakarta',
            'city' => 'Jakarta',
            'postal_code' => '12345',
            'district' => 'Kebayoran Baru',
            'roles' => 'seller',
        ]);

        Category::create([
            'seller_id' => 2,
            'name' => 'TV',
            'description' => 'TV category',
        ]);

        Product::factory(10)->create([
            'seller_id' => 2,
            'category_id' => 1,
        ]);
    }
}
