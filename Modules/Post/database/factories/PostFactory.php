<?php

namespace Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Models\Post;
use App\Models\User;        
use Illuminate\Support\Str; 

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraph(4),
            'user_id' => User::factory()->create()->id,
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}

