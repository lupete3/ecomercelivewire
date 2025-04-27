<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'coupon_code' => '0FF10',
            'coupon_type' => 'fixed',
            'coupon_value' => '100',
            'cart_value' => '1000',
            'end_date' => '2026-02-26 10:22:46',
        ]);

        Coupon::create([
            'coupon_code' => '0FF11',
            'coupon_type' => 'percent',
            'coupon_value' => '2',
            'cart_value' => '50',
            'end_date' => '2026-02-26 11:22:46',
        ]);
    }
}
