<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Очищаем папку с изображениями (опционально)
        Storage::deleteDirectory('public/products');
        Storage::makeDirectory('public/products');

        $products = [
            [
                'name' => 'Ноутбук Dell XPS 13',
                'description' => 'Мощный ультрабук с экраном 13 дюймов, процессором Intel Core i7 и 16 ГБ оперативной памяти.',
                'price' => 1299.99,
                'stock' => 10,
                'image' => null, // Можно добавить реальные изображения позже
            ],
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Смартфон Apple с камерой 48 МП, процессором A17 Pro и дисплеем Super Retina XDR.',
                'price' => 999.99,
                'stock' => 15,
                'image' => null,
            ],
            [
                'name' => 'Наушники Sony WH-1000XM5',
                'description' => 'Беспроводные наушники с активным шумоподавлением и временем работы до 30 часов.',
                'price' => 349.99,
                'stock' => 20,
                'image' => null,
            ],
            [
                'name' => 'Планшет Samsung Galaxy Tab S9',
                'description' => '11-дюймовый планшет с S-Pen, процессором Snapdragon 8 Gen 2 и дисплеем 120 Гц.',
                'price' => 849.99,
                'stock' => 8,
                'image' => null,
            ],
            [
                'name' => 'Фитнес-браслет Xiaomi Mi Band 8',
                'description' => 'Умный браслет с мониторингом сна, пульса и 150 спортивными режимами.',
                'price' => 49.99,
                'stock' => 50,
                'image' => null,
            ],
            [
                'name' => 'Игровая мышь Logitech G Pro',
                'description' => 'Профессиональная игровая мышь с сенсором HERO 25K и 8 программируемыми кнопками.',
                'price' => 129.99,
                'stock' => 30,
                'image' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        echo "Создано " . count($products) . " тестовых товаров\n";
    }
}