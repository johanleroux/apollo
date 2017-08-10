<html>
    <tr>
        <td>Sale ID</td>
        <td>Created At</td>
        <td>Customer Name</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Total</td>
    </tr>
    @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->sale_id }}</td>
            <td>{{ $sale->created_at }}</td>
            <td>{{ $sale->sale->customer->name }}</td>
            <td>{{ $sale->quantity }}</td>
            <td>{{ price_format($sale->price) }}</td>
            <td>{{ price_format($sale->total) }}</td>
        </tr>
    @endforeach
</html>
