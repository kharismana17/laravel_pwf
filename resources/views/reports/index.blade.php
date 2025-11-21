@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Stock Transactions</h3>
    <form method="GET" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-control">
                    <option value="">All products</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}" {{ request('product_id') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Type</label>
                <select name="type" class="form-control">
                    <option value="">All types</option>
                    <option value="in" {{ request('type')=='in' ? 'selected':'' }}>In</option>
                    <option value="out" {{ request('type')=='out' ? 'selected':'' }}>Out</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control" />
            </div>
            <div class="col-md-2">
                <label class="form-label">To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control" />
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
                <h6>Total In</h6>
                <div class="h4">{{ number_format($totalIn ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Total Out</h6>
                <div class="h4">{{ number_format($totalOut ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <h6>Net</h6>
                <div class="h4">{{ number_format((($totalIn ?? 0) - ($totalOut ?? 0))) }}</div>
            </div>
        </div>
    </div>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Type</th>
                <th>Qty</th>
                <th>User</th>
                <th>Note</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->product->name }}</td>
                <td>{{ $t->type }}</td>
                <td>{{ $t->quantity }}</td>
                <td>{{ $t->user?->name }}</td>
                <td>{{ $t->note }}</td>
                <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>
@endsection
