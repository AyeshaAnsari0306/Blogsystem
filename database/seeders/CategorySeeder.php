<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Category::create(['name' => 'Technology']);
        Category::create(['name' => 'Health']);
        Category::create(['name' => 'Travel']);
        Category::create(['name' => 'Food/Recipes']);
        Category::create(['name' => 'Finance']);
        Category::create(['name' => 'Lifestyle']);
        Category::create(['name' => 'Fitness']);
        Category::create(['name' => 'Fashion']);
        Category::create(['name' => 'Home']);
        Category::create(['name' => 'Sports']);
        Category::create(['name' => 'Entertainment']);
        Category::create(['name' => 'Careers/Jobs']);
        Category::create(['name' => 'News']);
        Category::create(['name' => 'Marketing']);
        Category::create(['name' => 'Relationship']);
        Category::create(['name' => 'Personal development']);

    }
}
