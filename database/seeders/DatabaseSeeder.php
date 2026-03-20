<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Post\Models\Post;
use Modules\Post\Database\Seeders\PostDatabaseSeeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Banner\Database\Seeders\BannerDatabaseSeeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Post::factory()->count(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            PostDatabaseSeeder::class,
            // UserSeeder::class,
            CategoryDatabaseSeeder::class,
            ProductDatabaseSeeder::class,
            BannerDatabaseSeeder::class

        ]);
    }
}
