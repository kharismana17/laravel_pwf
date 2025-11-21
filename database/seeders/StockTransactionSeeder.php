<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StockTransactionSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        $users = User::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            return;
        }

        // simple deterministic sample transactions
        $now = now();

        $sample = [
            // [sku, type, qty, days_ago, note]
            ['P001','in', 20, 10, 'Initial restock'],
            ['P001','out', 5, 9, 'Sold'],
            ['P002','in', 100, 15, 'Purchase'],
            ['P002','out', 12, 2, 'Used in cafe'],
            ['P003','in', 30, 7, 'New stock'],
            ['P003','out', 10, 1, 'Customer sale'],
            ['P004','in', 40, 20, 'Baker delivery'],
            ['P005','in', 25, 5, 'Supplier'],
            ['P005','out', 8, 3, 'Sold'],
        ];

        DB::transaction(function () use ($sample, $products, $users, $now) {
            foreach ($sample as $row) {
                [$sku, $type, $qty, $days, $note] = $row;

                $product = $products->firstWhere('sku', $sku) ?? $products->first();
                $user = $users->random();

                $createdAt = $now->copy()->subDays($days)->subMinutes(rand(0, 120));

                StockTransaction::create([
                    'product_id' => $product->id,
                    'type' => $type,
                    'quantity' => $qty,
                    'created_by' => $user->id,
                    'note' => $note,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);

                // update product stock accordingly
                if ($type === 'in') {
                    $product->increment('stock', $qty);
                } else {
                    $product->decrement('stock', $qty);
                }
            }
        });
    }
}
