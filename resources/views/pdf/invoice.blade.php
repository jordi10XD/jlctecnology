<!DOCTYPE html>
<html>
<head>
    <title>Factura JLC Tecnología</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .total { text-align: right; margin-top: 20px; font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="header">
        <h1>JLC Tecnología</h1>
        <p>RUC: 123456789001 | Tel: 0999999999</p>
        <h3>Orden #{{ $order->id }}</h3>
    </div>

    <p><strong>Cliente:</strong> {{ $order->customer_name }}</p>
    <p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total a Pagar: ${{ number_format($order->total, 2) }}
    </div>
</body>
</html>