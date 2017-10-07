<html>
    <tr>
        <td>Purchase ID</td>
        <td>Created At</td>
        <td>External Invoice</td>
        <td>Processed At</td>
        <td>Supplier Name</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Total</td>
    </tr>
    @foreach($purchases as $purchase)
        <tr>
            <td>{{ $purchase->purchase_id }}</td>
            <td>{{ $purchase->created_at }}</td>
            <td>{{ $purchase->purchase->ext_invoice_number }}</td>
            <td>{{ $purchase->purchase->processed_at }}</td>
            <td>{{ $purchase->purchase->supplier->name }}</td>
            <td>{{ $purchase->quantity }}</td>
            <td>{{ price_format($purchase->price) }}</td>
            <td>{{ price_format($purchase->total) }}</td>
        </tr>
    @endforeach
</html>
