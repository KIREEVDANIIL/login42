<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $printers = [
            // Лазерные принтеры
            ['name' => 'HP LaserJet Pro M404dn', 'price' => 24990.00],
            ['name' => 'Canon i-SENSYS LBP112', 'price' => 17990.00],
            ['name' => 'Brother HL-L2350DW', 'price' => 15990.00],
            ['name' => 'Xerox Phaser 3020', 'price' => 13990.00],
            ['name' => 'Pantum P3300DW', 'price' => 11990.00],
            
            // Цветные лазерные принтеры
            ['name' => 'HP Color LaserJet Pro M454dn', 'price' => 41990.00],
            ['name' => 'Canon i-SENSYS LBP673Cdw', 'price' => 37990.00],
            ['name' => 'Brother HL-L3270CDW', 'price' => 35990.00],
            ['name' => 'Xerox Phaser 6510', 'price' => 31990.00],
            
            // Струйные принтеры
            ['name' => 'HP OfficeJet Pro 9025e', 'price' => 27990.00],
            ['name' => 'Canon PIXMA G640', 'price' => 17990.00],
            ['name' => 'Epson EcoTank L3260', 'price' => 21990.00],
            ['name' => 'Brother DCP-T720DW', 'price' => 23990.00],
            
            // МФУ
            ['name' => 'HP LaserJet Pro MFP M428fdw', 'price' => 34990.00],
            ['name' => 'Canon i-SENSYS MF644Cdw', 'price' => 42990.00],
            ['name' => 'Epson WorkForce Pro WF-M5799', 'price' => 68990.00],
            ['name' => 'Brother MFC-L2710DW', 'price' => 19990.00],
            ['name' => 'Xerox VersaLink C400', 'price' => 38990.00],
            
            // Фотопринтеры
            ['name' => 'Epson SureColor P900', 'price' => 89990.00],
            ['name' => 'Canon PIXMA PRO-200', 'price' => 64990.00],
            ['name' => 'HP ENVY Photo 7855', 'price' => 14990.00],
            
            // Профессиональные принтеры
            ['name' => 'Ricoh SP 221S', 'price' => 13990.00],
            ['name' => 'Kyocera Ecosys P4040dn', 'price' => 32990.00],
            ['name' => 'OKI C332dn', 'price' => 44990.00],
            ['name' => 'Konica Minolta bizhub 227', 'price' => 47990.00],
        ];
        
        $printer = $this->faker->randomElement($printers);
        
        return [
            'name' => $printer['name'],
            'category_id' => Category::first()->id ?? Category::factory()->create(['name' => 'Принтеры']),
            'description' => $this->generatePrinterDescription($printer['name'], $printer['price']),
            'count' => $this->faker->numberBetween(1, 30),
            'price' => $printer['price'], // Цена в рублях
            'country_id' => Country::inRandomOrder()->first()->id ?? Country::factory(),
            'image' => 'products/printer-' . $this->faker->numberBetween(1, 8) . '.jpg',
        ];
    }
    
    /**
     * Генерация описания для принтера
     */
    private function generatePrinterDescription(string $printerName, float $price): string
    {
        $types = [
            'Лазерный принтер' => ['Черно-белая печать', 'Высокая скорость', 'Низкая стоимость отпечатка'],
            'Цветной лазерный принтер' => ['Цветная печать', 'Качество 1200x1200 dpi', 'Быстрая цветная печать'],
            'Струйный принтер' => ['Фотопечать', 'СНПЧ система', 'Низкая стоимость фотопечати'],
            'Многофункциональное устройство' => ['Печать, сканирование, копирование', 'Автоподатчик документов', 'Факс'],
            'Фотопринтер' => ['Профессиональная фотопечать', 'Широкий цветовой охват', 'Печать на различных носителях']
        ];
        
        $printerType = $this->faker->randomElement(array_keys($types));
        $features = $types[$printerType];
        
        $additionalFeatures = [
            'Двусторонняя печать',
            'Беспроводное подключение Wi-Fi',
            'Ethernet порт',
            'Сенсорный экран 4.3"',
            'Поддержка мобильной печати',
            'Облачная печать',
            'Автоматическая подача документов (ADF)',
            'Дуплексное сканирование',
            'Энергосберегающий режим',
            'Компактные размеры'
        ];
        
        $selectedAdditional = $this->faker->randomElements($additionalFeatures, 3);
        $allFeatures = array_merge($features, $selectedAdditional);
        
        return "{$printerType} {$printerName}. Цена: {$this->formatPrice($price)} рублей. " .
               "Характеристики: " . implode(', ', $allFeatures) . ". " .
               "Гарантия 1 год. Доставка по всей России. В наличии: {$this->faker->numberBetween(1, 30)} шт.";
    }
    
    /**
     * Форматирование цены
     */
    private function formatPrice(float $price): string
    {
        return number_format($price, 0, '', ' ');
    }
}