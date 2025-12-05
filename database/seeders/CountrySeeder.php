<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Россия'],
            ['name' => 'Китай'],
            ['name' => 'Япония'],
            ['name' => 'Германия'],
            ['name' => 'США'],
            ['name' => 'Южная Корея'],
            ['name' => 'Вьетнам'],
            ['name' => 'Малайзия'],
            ['name' => 'Таиланд'],
            ['name' => 'Сингапур'],
        ];
        
        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}