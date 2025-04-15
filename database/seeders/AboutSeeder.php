<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Faker;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataFaker = Faker\Factory::create();

        $images = [
            'assets/imgs/page/about-1.png',
        ];

        About::create([
            'title' => $dataFaker->text(20),
            'description' => $dataFaker->text(30),
            'image' => $images[0],
        ]);
    }
}
