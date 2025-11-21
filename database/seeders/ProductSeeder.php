<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['sku' => 'P001', 'name' => 'Kopi Arabica 250g', 'description' => 'Kopi arabica pilihan, sangrai medium.', 'price' => 75000, 'stock' => 50],
            ['sku' => 'P002', 'name' => 'Gula Pasir 1kg', 'description' => 'Gula pasir berkualitas, cocok untuk minuman.', 'price' => 15000, 'stock' => 200],
            ['sku' => 'P003', 'name' => 'Susu UHT 1L', 'description' => 'Susu UHT segar, bergizi.', 'price' => 20000, 'stock' => 120],
            ['sku' => 'P004', 'name' => 'Roti Tawar 500g', 'description' => 'Roti tawar lembut, siap saji.', 'price' => 12000, 'stock' => 80],
            ['sku' => 'P005', 'name' => 'Minyak Goreng 2L', 'description' => 'Minyak goreng berkualitas, 2 liter.', 'price' => 42000, 'stock' => 60],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['sku' => $p['sku']], $p);
        }
    }
}
