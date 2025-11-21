@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Print Product Labels</h3>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('products.labels.print') }}" method="GET">
        <div class="mb-2">
            <button type="button" id="selectAll" class="btn btn-sm btn-outline-primary">Select All</button>
            <button type="submit" class="btn btn-primary">Print Selected</button>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th style="width:120px">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $p->id }}" class="sel-box" id="sel-{{ $p->id }}">
                        </td>
                        <td>{{ $p->sku }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ number_format($p->price,2) }}</td>
                        <td>{{ $p->stock }}</td>
                        <td style="width:120px">
                            <div class="input-group input-group-sm">
                                <input type="number" name="qty[{{ $p->id }}]" value="1" min="1" class="form-control qty-input" data-for="sel-{{ $p->id }}">
                                <span class="input-group-text">pcs</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>

@section('scripts')
    <script>
    document.getElementById('selectAll').addEventListener('click', function(){
        const boxes = document.querySelectorAll('input[name="ids[]"]');
        let all = true;
        boxes.forEach(b => { if(!b.checked) all = false; });
        boxes.forEach(b => b.checked = !all);
    });

    // disable/enable qty inputs depending on checkbox
    document.querySelectorAll('.sel-box').forEach(cb => {
        cb.addEventListener('change', function(e){
            const id = e.target.id;
            const qty = document.querySelector('input.qty-input[data-for="'+id+'"]');
            if (qty) qty.disabled = !e.target.checked;
        });
        // init state
        const ev = new Event('change'); cb.dispatchEvent(ev);
    });
    </script>
@endsection

@endsection