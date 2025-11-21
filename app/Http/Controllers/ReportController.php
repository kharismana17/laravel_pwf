<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = StockTransaction::with(['product','user'])->orderBy('created_at', 'desc');

        // date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // totals (for the filtered set)
        $totalsQuery = (clone $query);
        $totalIn = $totalsQuery->where('type', 'in')->sum('quantity');
        $totalOut = $totalsQuery->where('type', 'out')->sum('quantity');

        // export CSV if requested (export=csv)
        if ($request->filled('export') && $request->export === 'csv') {
            $all = $query->get();
            $response = new StreamedResponse(function () use ($all) {
                $out = fopen('php://output', 'w');
                fputcsv($out, ['id','product','type','quantity','user','note','date']);
                foreach ($all as $t) {
                    fputcsv($out, [
                        $t->id,
                        $t->product?->name,
                        $t->type,
                        $t->quantity,
                        $t->user?->name,
                        $t->note,
                        $t->created_at->format('Y-m-d H:i:s'),
                    ]);
                }
                fclose($out);
            });

            $filename = 'stock-transactions-' . now()->format('Ymd_His') . '.csv';
            $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
            return $response;
        }

        $transactions = $query->paginate(30)->withQueryString();

        $products = Product::orderBy('name')->get();

        return view('reports.index', compact('transactions','products','totalIn','totalOut'));
    }
}
