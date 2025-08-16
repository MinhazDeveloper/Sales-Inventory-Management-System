<h3>Sales Report from {{ request('date_from') }} to {{ request('date_to') }}</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>Sale ID</th>
        <th>Customer Name</th>
        <th>Sale Date</th>
        <th>Total Amount</th>
    </tr>
    @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ $sale->customer_name }}</td>
            <td>{{ $sale->sale_date }}</td>
            <td>{{ $sale->total_amount }}</td>
        </tr>
    @endforeach
</table>
