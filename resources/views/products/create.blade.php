@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Product</h3>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>SKU</label>
            <input name="sku" class="form-control" />
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input name="price" class="form-control" required type="number" step="0.01" />
        </div>
        <div class="mb-3">
            <label>Initial Stock</label>
            <input name="stock" class="form-control" type="number" value="0" />
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
