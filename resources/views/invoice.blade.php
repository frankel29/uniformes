<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 28px;
            margin: 0;
            color: #333333;
        }
        .header h2 {
            font-size: 22px;
            margin: 0;
            color: #666666;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            font-size: 16px;
            margin: 5px 0;
            color: #333333;
        }
        .order-summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-summary th, .order-summary td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .order-summary th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-right: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RM SPORT</h1>
            <h2>Comprobante de Venta</h2>
        </div>

        <div class="details">
            <p><strong>Cliente:</strong> {{ $first_name }} {{ $last_name }}</p>
            <p><strong>Teléfono:</strong> {{ $phone }}</p>
            <p><strong>Dirección:</strong> {{ $address }}</p>
            <p><strong>Ciudad:</strong> {{ $city }}</p>
        </div>

        <h3>Resumen de la Orden</h3>
        <table class="order-summary">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart_items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ Number::currency($item['total_amount'], 'USD') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p>Total General: {{ Number::currency($grand_total, 'USD') }}</p>
        </div>
    </div>
</body>
</html>
