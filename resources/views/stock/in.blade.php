@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Stock In - {{ $product->name }}</h3>

    <form action="{{ route('products.stock.store', $product) }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="in">
        <div class="mb-3">
            <label>Quantity</label>
            <input name="quantity" class="form-control" type="number" value="1" min="1" required />
        </div>
        <div class="mb-3">
            <label>Note</label>
            <textarea name="note" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Add Stock</button>
    </form>
</div>
@endsection
