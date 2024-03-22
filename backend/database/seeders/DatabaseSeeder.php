<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\ProductSize;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $pizzaNames = ['Маргарита', 'Пепперони', 'Маринара', 'Гавайская',
            'Цыпленок', 'Гавайская', 'Карбонара', 'Фреш', 'C ананасом xdd'];

        $drinkNames = ['Кока-кола', 'Кофе', 'Чай', 'Кофе с молоком', 'Кофе с сахаром'];

        $pizzaCategory = Category::create(['name' => 'pizza']);
        $drinkCategory = Category::create(['name' => 'drink']);

        foreach ($pizzaNames as $name) {
            $this->createProduct($pizzaCategory, $name);
        }

        foreach ($drinkNames as $name) {
            $this->createProduct($drinkCategory, $name);
        }
    }


    private function createProduct(Category $category, string $name): void
    {
        $product = Product::factory()->create([
            'name' => $name,
            'category_id' => $category->id
        ]);

        if ($category->name === 'pizza') {
            foreach (ProductSize::cases() as $size) {
                $this->createProductDetail($product, $size->value, random_int(100, 900));
            }
        } elseif ($category->name === 'drink') {
            $this->createProductDetail($product, 'small', 5);
        }
    }

    private function createProductDetail(Product $product, string $size, int $price): void
    {
        ProductDetails::factory()->create([
            'product_id' => $product->id,
            'size' => $size,
            'price' => $price
        ]);
    }

}
