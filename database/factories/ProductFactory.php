<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(100, 99999),
            'description' => fake()->paragraph(4),
            'price' => fake()->numberBetween(10000, 750000),
            'stock' => fake()->numberBetween(1, 100),
            'umkm_seller' => 'UMKM ' . fake()->company(),
        ];
    }
}
