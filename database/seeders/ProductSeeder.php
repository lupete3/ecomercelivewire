<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataFaker = Faker\Factory::create();

        $images = [
            'assets/imgs/shop/product-1-1.jpg',
            'assets/imgs/shop/product-2-1.jpg',
            'assets/imgs/shop/product-3-1.jpg',
            'assets/imgs/shop/product-4-1.jpg',
            'assets/imgs/shop/product-5-1.jpg',
            'assets/imgs/shop/product-6-1.jpg',
            'assets/imgs/shop/product-7-1.jpg',
            'assets/imgs/shop/product-8-1.jpg',
            'assets/imgs/shop/product-9-1.jpg',
            'assets/imgs/shop/product-10-1.jpg',
            'assets/imgs/shop/product-11-1.jpg',
            'assets/imgs/shop/product-12-1.jpg',
            'assets/imgs/shop/product-13-1.jpg',
            'assets/imgs/shop/product-14-1.jpg',
            'assets/imgs/shop/product-15-1.jpg',
            'assets/imgs/shop/product-16-1.jpg',
        ];

        $size = [
            'S', 'M', 'L', 'XL', 'XXL', 'XXXL'
        ];

        $color = [
            'red', 'green', 'yellow', 'white', 'pink'
        ];

        foreach (range(1,100) as $key => $value) {
            $productName = $dataFaker->unique()->name;
            Product::create([
                'name' => $productName,
                'slug' => Str::slug($productName),
                'short_description' => $dataFaker->text(200),
                'long_description' => $dataFaker->text(1000),
                'regular_price' => $dataFaker->numberBetween(100,500),
                'sale_price' => $dataFaker->numberBetween(20,400),
                'image' => $images[rand(0,15)],
                'images' => json_encode($images),
                'size' => json_encode($size),
                'color' => json_encode($color),
                'category_id' => $dataFaker->numberBetween(0,10),
            ]);

        }
    }
}
