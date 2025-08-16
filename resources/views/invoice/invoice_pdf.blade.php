<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $sale->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice #{{ $sale->id }}</h2>
    <p><strong>Customer:</strong> {{ $sale->customer_name }}</p>
    <p><strong>Date:</strong> {{ $sale->created_at->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>SL</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->product->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }}</td>
                <td>{{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ number_format($sale->total_amount, 2) }}</h3>
</body>
</html>
