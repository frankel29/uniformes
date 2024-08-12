<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 20px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        tfoot td {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Ventas</h1>
        <h2>RM SPORT</h2>

        <table>
            <thead>
                <tr>
                    <th>Fecha de Venta</th>
                    <th>Artículo</th>
                    <th>Valor de la Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $ordenes)
                    @foreach($ordenes as $orden)
                        @foreach($orden->items as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($orden->created_at)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ number_format($item->total_amount, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ number_format($totalVentas, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
