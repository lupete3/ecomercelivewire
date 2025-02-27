<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'assets/imgs/shop/category-thumb-1.jpg',
            'assets/imgs/shop/category-thumb-2.jpg',
            'assets/imgs/shop/category-thumb-3.jpg',
            'assets/imgs/shop/category-thumb-4.jpg',
            'assets/imgs/shop/category-thumb-5.jpg',
            'assets/imgs/shop/category-thumb-6.jpg',
            'assets/imgs/shop/category-thumb-7.jpg',
            'assets/imgs/shop/category-thumb-8.jpg',
        ];

        $categories = [
            'Electronic Devise',
            'TV & Home Appliance',
            'Health & Beauty',
            'Babies & Toys',
            'Groceries & Pets',
            'Home & Lifestyle',
            'Homens Fashion',
            'Mens Fashion',
            'Watches & Accessories',
            'Sport & Outdoor',
            'Automotive & Motorbike',
        ];

        foreach ($categories as $key => $value) {
            Category::create([
                'name' => $value,
                'slug' => Str::slug($value),
                'image' => $images[rand(0,3)],
                'status' => rand(0,1)
            ]);
        }
    }
}
