@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Invoice #{{ $sale->id }}</h2>
    <p>Customer: {{ $sale->customer_name }}</p>
    <p>Date: {{ $sale->created_at->format('d-m-Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: {{ $sale->total_amount }}</h4>
    <a href="{{ route('invoice.download', $sale->id) }}" class="btn btn-primary">Download PDF</a>

</div>
@endsection
