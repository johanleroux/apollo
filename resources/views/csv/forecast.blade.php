<html>
    <tr>
        <td>Date</td>
        <td>Forecast</td>
        <td>Adj. Forecast</td>
    </tr>
    @foreach ($forecast['labels'] as $label)
        <tr>
            <td>{{ $label }}</td>
            <td>{{ $forecast['data'][$loop->index] }}</td>
            <td>{{ $forecast['adjusted'][$loop->index] }}</td>
        </tr>
    @endforeach
</html>
