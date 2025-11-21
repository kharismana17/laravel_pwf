@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Products</h3>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
            <a href="{{ route('products.labels') }}" class="btn btn-info">Print Labels</a>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reports</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>SKU</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->sku }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ number_format($p->price,2) }}</td>
                <td>{{ $p->stock }}</td>
                <td>
                    <a href="{{ route('products.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('products.stock.in', $p) }}" class="btn btn-sm btn-success">Stock In</a>
                    <a href="{{ route('products.stock.out', $p) }}" class="btn btn-sm btn-danger">Stock Out</a>
                    <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
