<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->paginate(20);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sku' => 'nullable|string|unique:products,sku',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $data['stock'] = $request->input('stock', 0);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    // show label selection page
    public function labels()
    {
        $products = Product::orderBy('name')->get();
        return view('products.labels_select', compact('products'));
    }

    // print labels for selected products (expect `ids[]` or `ids` comma list)
    public function printLabels(Request $request)
    {
        $ids = $request->input('ids', []);
        if (is_string($ids)) {
            $ids = array_filter(explode(',', $ids));
        }

        if (empty($ids)) {
            return redirect()->route('products.labels')->with('success', 'No products selected.');
        }

        $qtys = $request->input('qty', []); // keyed by product id

        $products = Product::whereIn('id', $ids)->orderBy('name')->get();

        // attach requested print quantity to each product (at least 1)
        $products->transform(function($p) use ($qtys) {
            $q = isset($qtys[$p->id]) ? (int) $qtys[$p->id] : 1;
            $p->print_qty = max(1, $q);
            return $p;
        });

        return view('products.labels_print', compact('products'));
    }
}
