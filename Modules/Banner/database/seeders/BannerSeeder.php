<?php

namespace Modules\Banner\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Banner\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Summer Collection 2026',
                'image' => 'images/banner-image-1.jpg',
                'description' => 'Discover our latest summer collection with amazing discounts',
                'product_id' => 1,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Arrivals',
                'image' => 'images/banner-image-2.jpg',
                'description' => 'Check out the newest additions to our store',
                'product_id' => 3,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Special Offer',
                'image' => 'images/banner-image-3.jpg',
                'description' => 'Limited time offer - Up to 50% off on selected items',
                'product_id' => 5,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kids Fashion',
                'image' => 'images/banner-image-4.jpg',
                'description' => 'Trendy and comfortable clothing for your little ones',
                'product_id' => 6,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Premium Collection',
                'image' => 'images/banner-image-5.jpg',
                'description' => 'Luxury fashion items for the discerning customer',
                'product_id' => 8,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Casual Wear',
                'image' => 'images/banner-image-6.jpg',
                'description' => 'Comfortable and stylish everyday clothing',
                'product_id' => 10,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Banner::insert($banners);
    }
}
