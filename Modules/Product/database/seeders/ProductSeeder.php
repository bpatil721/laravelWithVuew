<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Classic T-Shirt',
                'price' => 29.99,
                'description' => 'Comfortable cotton t-shirt perfect for everyday wear',
                'image' => 'images/product-item-1.jpg',
                'category_id' => 1, // Male
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Denim Jeans',
                'price' => 79.99,
                'description' => 'Premium quality denim jeans with modern fit',
                'image' => 'images/product-item-2.jpg',
                'category_id' => 1, // Male
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Summer Dress',
                'price' => 59.99,
                'description' => 'Elegant floral summer dress for women',
                'image' => 'images/product-item-3.jpg',
                'category_id' => 2, // Female
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casual Blouse',
                'price' => 39.99,
                'description' => 'Stylish casual blouse for office and casual wear',
                'image' => 'images/product-item-4.jpg',
                'category_id' => 2, // Female
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kids Hoodie',
                'price' => 34.99,
                'description' => 'Warm and cozy hoodie for kids',
                'image' => 'images/product-item-5.jpg',
                'category_id' => 3, // Kids
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kids Sneakers',
                'price' => 44.99,
                'description' => 'Comfortable sneakers for active kids',
                'image' => 'images/product-item-6.jpg',
                'category_id' => 3, // Kids
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sport Jacket',
                'price' => 89.99,
                'description' => 'Lightweight sport jacket for outdoor activities',
                'image' => 'images/product-item-7.jpg',
                'category_id' => 1, // Male
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Evening Gown',
                'price' => 129.99,
                'description' => 'Elegant evening gown for special occasions',
                'image' => 'images/product-item-8.jpg',
                'category_id' => 2, // Female
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kids Backpack',
                'price' => 24.99,
                'description' => 'Colorful and durable backpack for school',
                'image' => 'images/product-item-9.jpg',
                'category_id' => 3, // Kids
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casual Shirt',
                'price' => 49.99,
                'description' => 'Classic casual shirt for everyday style',
                'image' => 'images/product-item-10.jpg',
                'category_id' => 1, // Male
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}
