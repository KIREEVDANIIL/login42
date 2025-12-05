<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем категорию Принтеры если её нет
        if (Category::where('name', 'Принтеры')->doesntExist()) {
            Category::create(['name' => 'Принтеры']);
        }
        
        // Удаляем старые продукты
        Product::query()->delete();
        
        // Создаем 25 разных принтеров
        Product::factory(25)->create();
    }
}