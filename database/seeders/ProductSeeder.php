<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Ноутбук Dell XPS 13',
                'description' => '13-дюймовый ноутбук с процессором Intel Core i7',
                'price' => 1299.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 10,
            ],
            [
                'name' => 'Смартфон iPhone 15',
                'description' => 'Смартфон Apple с камерой 48 МП',
                'price' => 999.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 25,
            ],
            [
                'name' => 'Наушники Sony WH-1000XM4',
                'description' => 'Беспроводные наушники с шумоподавлением',
                'price' => 349.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 30,
            ],
            [
                'name' => 'Планшет Samsung Tab S9',
                'description' => '11-дюймовый планшет с AMOLED дисплеем',
                'price' => 799.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 15,
            ],
            [
                'name' => 'Часы Apple Watch Series 9',
                'description' => 'Умные часы с функцией ЭКГ',
                'price' => 429.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 20,
            ],
            [
                'name' => 'Фотоаппарат Canon EOS R6',
                'description' => 'Зеркальная камера 20.1 МП',
                'price' => 2499.99,
                'image' => 'https://via.placeholder.com/400x300',
                'stock' => 8,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}