<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de Usuarios</h2>
    </div>
    <div class="header">
        <h3>RM SPORT</h3>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Mes de Creación del Usuario</th>
                <th>Nombre del Usuario</th>
                <th>Correo del Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->created_at->format('F Y') }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        Total de Usuarios: {{ $totalUsers }}
    </div>
</body>
</html>
