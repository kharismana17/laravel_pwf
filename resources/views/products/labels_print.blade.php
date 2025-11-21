@extends('layouts.app')

@section('content')

<style>
    .receipt-wrapper {
        max-width: 320px;
        margin: auto;
        background: #fff;
        padding: 18px;
        border-radius: 8px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        font-family: 'Courier New', monospace;
    }

    .store-name {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 4px;
    }
    .store-address {
        text-align: center;
        font-size: 11px;
        margin-bottom: 10px;
    }
    .receipt-meta {
        text-align: center;
        font-size: 11px;
        border-bottom: 1px dashed #aaa;
        padding-bottom: 6px;
        margin-bottom: 10px;
    }

    .table-receipt th, .table-receipt td {
        font-size: 12px;
        padding: 2px 0;
    }

    @media print {
        body * { visibility: hidden !important; }
        #print-area, #print-area * { visibility: visible !important; }
        #print-area { position: absolute; left: 0; top: 0; width: 100%; }
        .receipt-wrapper { box-shadow: none !important; }
        #action-buttons { display: none !important; }
    }

    #action-buttons {
        max-width: 320px;
        margin: 15px auto;
    }
</style>

<div id="print-area">
    <div class="receipt-wrapper">

        <div class="store-name">{{ config('app.name') }}</div>
        <div class="store-address">
            {{ config('app.address', 'Alamat toko belum diset') }}
        </div>

        <div class="receipt-meta">
            {{ now()->format('Y-m-d') }} | {{ now()->format('H:i') }}
        </div>

        @php
            $totalItems = 0;
            $totalPrice = 0;
        @endphp

        <table class="table-receipt w-100">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-end">Qty</th>
                    <th class="text-end">Harga</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $p)
                    @php
                        $qty = $p->print_qty ?? 1;
                        $subtotal = $p->price * $qty;
                        $totalItems += $qty;
                        $totalPrice += $subtotal;
                    @endphp

                    <tr>
                        <td>{{ $p->name }}</td>
                        <td class="text-end">{{ $qty }}</td>
                        <td class="text-end">Rp {{ number_format($subtotal,0,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <div class="d-flex justify-content-between" style="font-size: 13px; font-weight:bold;">
            <span>Total</span>
            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
        </div>

        <div class="text-center mt-3 mb-2" style="font-size: 11px;">
            * TERIMA KASIH *
        </div>

        @php
            $first = $products->first();
            $barcodeValue = $first->sku ?: $first->id;
        @endphp

        <div class="text-center mt-2">
            <svg id="barcode-main" style="width:100%;"></svg>
        </div>

    </div>
</div>

{{-- Tombol tindakan di bawah struk --}}
<div id="action-buttons" class="text-center">
    <a href="{{ route('products.labels') }}" class="btn btn-secondary">Kembali</a>
    <button onclick="window.print()" class="btn btn-primary ms-2">Print</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    try {
        JsBarcode("#barcode-main", "{{ $barcodeValue }}", {
            format: "CODE128",
            displayValue: true,
            fontSize: 14,
            height: 60
        });
    } catch(e) {
        console.warn("Barcode error:", e);
    }
});
</script>

@endsection
