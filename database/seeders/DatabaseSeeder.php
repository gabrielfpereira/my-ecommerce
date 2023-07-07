<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Database\Factories\CategoryFactory;
use Database\Factories\CategoryProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Gabriel Pereira',
            'email' => 'admin@admin.com',
        ]);

        // Category::factory(5)->create();
        Product::factory(15)->has(Category::factory())->create();
    }
}
