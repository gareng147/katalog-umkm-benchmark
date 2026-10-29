<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Makanan & Minuman',
            'Kerajinan Tangan',
            'Fashion & Batik',
            'Pertanian & Herbal',
            'Jasa Kreatif'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }

        Product::factory(500)->create();
    }
}
