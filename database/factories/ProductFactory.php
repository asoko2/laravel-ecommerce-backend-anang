<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 'name' => fake()->name(),
            // 'email' => fake()->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),
        return [
            'seller_id' => 2,
            'category_id' => 1,
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1000000, 10000000),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}
