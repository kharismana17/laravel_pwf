<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	public function index()
	{
		$productCount = Product::count();
		$totalStock = Product::sum('stock');

		// total sales revenue (using current product price * qty sold)
		$totalSales = DB::table('stock_transactions')
			->join('products', 'products.id', '=', 'stock_transactions.product_id')
			->where('stock_transactions.type', 'out')
			->select(DB::raw('SUM(stock_transactions.quantity * products.price) as revenue'))
			->value('revenue') ?? 0;

		// recent transactions
		$recent = StockTransaction::with(['product','user'])->orderBy('created_at','desc')->limit(8)->get();

		// sales last 7 days (date => qty)
		$start = now()->subDays(6)->startOfDay();
		$salesPerDay = StockTransaction::where('type','out')
			->where('created_at', '>=', $start)
			->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(quantity) as qty'))
			->groupBy('date')
			->orderBy('date')
			->get()
			->keyBy('date');

		// prepare labels and data for last 7 days
		$labels = [];
		$data = [];
		for ($i = 6; $i >= 0; $i--) {
			$d = now()->subDays($i)->format('Y-m-d');
			$labels[] = now()->subDays($i)->format('M d');
			$data[] = (int) ($salesPerDay->has($d) ? $salesPerDay->get($d)->qty : 0);
		}

		return view('dashboard.index', compact('productCount','totalStock','totalSales','recent','labels','data'));
	}
}
