<?php

namespace Database\Factories;

use App\Enums\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetails>
 */
class ProductDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => $this->faker->randomElement(ProductSize::cases()),
            'price' => $this->faker->numberBetween(5, 1000),
        ];
    }
}
