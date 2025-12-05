<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'country_id',
        'description',
        'image',
        'count',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Получить отформатированную цену в рублях
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, '', ' ') . ' ₽';
    }

    /**
     * Получить цену без копеек
     */
    public function getPriceWithoutCentsAttribute(): string
    {
        return number_format($this->price, 0, '', ' ');
    }
}
