<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('stock_transactions')
            ->join('products', 'products.id', '=', 'stock_transactions.product_id')
            ->where('stock_transactions.type', 'out');

        if ($request->filled('product_id')) {
            $query->where('products.id', $request->product_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('stock_transactions.created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('stock_transactions.created_at', '<=', $request->date_to);
        }

        // aggregate by product
        $rows = (clone $query)
            ->select('products.id as product_id', 'products.sku', 'products.name', 'products.price',
                DB::raw('SUM(stock_transactions.quantity) as qty_sold'),
                DB::raw('SUM(stock_transactions.quantity * products.price) as revenue'))
            ->groupBy('products.id','products.sku','products.name','products.price')
            ->orderByDesc('qty_sold')
            ->get();

        // totals
        $totals = (clone $query)
            ->select(DB::raw('SUM(stock_transactions.quantity) as total_qty'), DB::raw('SUM(stock_transactions.quantity * products.price) as total_revenue'))
            ->first();

        $products = Product::orderBy('name')->get();

        // CSV export
        if ($request->filled('export') && $request->export === 'csv') {
            $all = $rows;
            $response = new StreamedResponse(function () use ($all) {
                $out = fopen('php://output', 'w');
                fputcsv($out, ['product_id','sku','product_name','price','qty_sold','revenue']);
                foreach ($all as $r) {
                    fputcsv($out, [
                        $r->product_id,
                        $r->sku,
                        $r->name,
                        number_format($r->price,2,'.',''),
                        $r->qty_sold,
                        number_format($r->revenue,2,'.',''),
                    ]);
                }
                fclose($out);
            });

            $filename = 'sales-report-' . now()->format('Ymd_His') . '.csv';
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
            return $response;
        }

        return view('reports.sales', [
            'rows' => $rows,
            'products' => $products,
            'totals' => $totals,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'product_selected' => $request->product_id,
        ]);
    }
}
