<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'name', 'description', 'price', 'stock'
    ];

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function adjustStock(int $quantity, string $type)
    {
        if ($type === 'in') {
            $this->increment('stock', $quantity);
        } elseif ($type === 'out') {
            $this->decrement('stock', $quantity);
        }

        $this->refresh();
    }
}
