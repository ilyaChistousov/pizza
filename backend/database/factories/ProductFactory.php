<?php

namespace Database\Factories;

use App\Enums\ProductCategory;
use App\Facade\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => Image::saveTestImage()
        ];
    }
}
