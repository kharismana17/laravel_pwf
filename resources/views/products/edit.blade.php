@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Product</h3>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>SKU</label>
            <input name="sku" class="form-control" value="{{ $product->sku }}" />
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ $product->name }}" required />
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input name="price" class="form-control" value="{{ $product->price }}" required type="number" step="0.01" />
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
