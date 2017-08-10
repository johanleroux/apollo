<html>
    <tr>
        <td>Date</td>
        <td>Quantity</td>
        <td>Value</td>
    </tr>
    @foreach ($report['quantity']['labels'] as $label)
        <tr>
            <td>{{ $label }}</td>
            <td>{{ $report['quantity']['data'][$loop->index] }}</td>
            <td>{{ $report['value']['data'][$loop->index] }}</td>
        </tr>
    @endforeach
</html>
