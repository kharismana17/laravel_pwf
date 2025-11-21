<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{
    public function createIn(Product $product)
    {
        return view('stock.in', compact('product'));
    }

    public function createOut(Product $product)
    {
        return view('stock.out', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);
        $user = auth()->user();

        // Prevent negative stock for non-admins
        if ($data['type'] === 'out' && $data['quantity'] > $product->stock) {
            if (!$user || $user->role !== 'admin') {
                return back()->withErrors(['quantity' => 'Insufficient stock. Contact admin for approval.']);
            }

            // Admin override: log the event for audit
            Log::warning('Admin stock override', [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'requested_qty' => $data['quantity'],
                'current_stock' => $product->stock,
                'admin_id' => $user->id,
                'admin_name' => $user->name,
            ]);
        }

        DB::transaction(function () use ($data, $product, $user) {
            StockTransaction::create([
                'product_id' => $product->id,
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'created_by' => $user?->id,
                'note' => $data['note'] ?? null,
            ]);

            if ($data['type'] === 'in') {
                $product->increment('stock', $data['quantity']);
            } else {
                // ensure stock doesn't go below negative if admin forced it
                $newStock = $product->stock - $data['quantity'];
                $product->stock = $newStock;
                $product->save();
            }
        });

        return redirect()->route('products.index')->with('success', 'Stock transaction saved.');
    }
}
