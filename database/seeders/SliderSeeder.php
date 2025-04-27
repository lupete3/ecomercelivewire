<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Faker;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataFaker = Faker\Factory::create();

        $images = [
            'assets/imgs/slider/slider-1.png',
            'assets/imgs/slider/slider-2.png',
        ];


        foreach (range(1,5) as $key => $value) {
            $sliderTitle = $dataFaker->unique()->name;
            Slider::create([
                'top_title' => $sliderTitle,
                'slug' => Str::slug($sliderTitle),
                'title' => $dataFaker->text(20),
                'sub_title' => $dataFaker->text(30),
                'link' => 'http://ecommerce-livewire.test',
                'offer' => $dataFaker->numberBetween(10,75),
                'image' => $images[rand(0,1)],
                'start_date' => '2026-02-25 10:22:46',
                'end_date' => '2026-02-28 10:22:46',
                'type' => 'slider',
                'status' => 1,
            ]);

        }
    }
}
