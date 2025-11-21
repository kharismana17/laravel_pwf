@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Penjualan</h3>

    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-control">
                    <option value="">Semua produk</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}" {{ (string)$product_selected === (string)$prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">From</label>
                <input type="date" name="date_from" value="{{ $date_from }}" class="form-control" />
            </div>
            <div class="col-md-2">
                <label class="form-label">To</label>
                <input type="date" name="date_to" value="{{ $date_to }}" class="form-control" />
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->except('page'), ['export' => 'csv'])) }}" class="btn btn-outline-secondary">Export CSV</a>
            </div>
        </div>
    </form>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Terjual</h6>
                <div class="h4">{{ number_format($totals->total_qty ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Pendapatan</h6>
                <div class="h4">Rp {{ number_format($totals->total_revenue ?? 0,0,',','.') }}</div>
            </div>
        </div>
    </div>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>SKU</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Terjual (qty)</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $i => $r)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $r->sku }}</td>
                <td>{{ $r->name }}</td>
                <td>Rp {{ number_format($r->price,0,',','.') }}</td>
                <td>{{ $r->qty_sold }}</td>
                <td>Rp {{ number_format($r->revenue,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
