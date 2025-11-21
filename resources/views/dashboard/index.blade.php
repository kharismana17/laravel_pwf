@extends('layouts.app')

@section('content')
<style>
    .dashboard-hero { padding: 8px 0 14px; }
    .dashboard-hero .icon-box { width:64px; height:64px; display:flex; align-items:center; justify-content:center; background:#e9f6ff; border-radius:8px; box-shadow: 0 1px 3px rgba(13,110,253,0.06); }
    .dashboard-hero .store-title { font-size:1.25rem; font-weight:700; color:#0d6efd; margin:0; }
    .dashboard-hero .store-desc { color:#6c757d; font-size:0.95rem; margin-top:3px; }
    .dashboard-hero .hero-action { padding:.45rem .75rem; font-weight:600; }
    @media (min-width:768px) { .dashboard-hero .store-title { font-size:1.5rem; } }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 dashboard-hero">
        <div class="d-flex align-items-center" style="gap:16px">
            <div class="icon-box">
                {{-- Inline cash register SVG icon --}}
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="4" width="20" height="14" rx="2" stroke="#0d6efd" stroke-width="1.2" fill="#ffffff" />
                    <rect x="3" y="12" width="18" height="4" fill="#0d6efd" opacity="0.08" />
                    <rect x="6" y="7" width="6" height="3" rx="0.5" fill="#0d6efd" />
                    <rect x="15" y="7" width="4" height="3" rx="0.5" fill="#adb5bd" />
                    <rect x="6" y="16" width="12" height="2" rx="0.5" fill="#6c757d" />
                </svg>
            </div>
            <div>
                <h1 class="store-title">{{ config('app.name') }}</h1>
                <div class="store-desc">{{ config('app.description', 'Sistem kasir sederhana untuk manajemen produk, stok, dan transaksi.') }}</div>
            </div>
        </div>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-primary hero-action">Open POS</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Products</h6>
                        <div class="h4">{{ number_format($productCount) }}</div>
                    </div>
                    <div class="text-muted-sm">Total</div>
                </div>
                <div class="mt-2"><a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Manage</a></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Total Stock</h6>
                        <div class="h4">{{ number_format($totalStock) }}</div>
                    </div>
                    <div class="text-muted-sm">Units</div>
                </div>
                <div class="mt-2"><a href="{{ route('reports.index') }}" class="btn btn-sm btn-secondary">Transactions</a></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Total Sales</h6>
                        <div class="h4">Rp {{ number_format($totalSales,0,',','.') }}</div>
                    </div>
                    <div class="text-muted-sm">Revenue</div>
                </div>
                <div class="mt-2"><a href="{{ route('reports.sales') }}" class="btn btn-sm btn-outline-primary">Sales Report</a></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6 class="mb-1">Quick Actions</h6>
                <div class="mt-2 d-flex flex-column gap-2">
                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">Add Product</a>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">View Products</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 g-3">
        <div class="col-md-8">
            <div class="card p-3">
                <h6>Sales (last 7 days)</h6>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h6>Recent Transactions</h6>
                <table class="table table-sm mt-2 mb-0">
                    <thead>
                        <tr><th>No</th><th>Product</th><th>Type</th><th>Qty</th></tr>
                    </thead>
                    <tbody>
                        @foreach($recent as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->product?->name }}</td>
                            <td>{{ ucfirst($t->type) }}</td>
                            <td>{{ $t->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const labels = @json($labels);
        const data = @json($data);

        const ctx = document.getElementById('salesChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Qty sold',
                    data: data,
                    backgroundColor: 'rgba(13,110,253,0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    })();
</script>
@endpush
@endsection
