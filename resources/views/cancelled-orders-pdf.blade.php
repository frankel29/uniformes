<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas Canceladas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="title">Reporte de Ventas Canceladas</div>
    <div class="subtitle">RM SPORT</div>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cancelledOrders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ number_format($order->grand_total, 2) }} USD</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total de Órdenes Canceladas: {{ number_format($totalCancelled, 2) }} USD
    </div>
</body>
</html>
