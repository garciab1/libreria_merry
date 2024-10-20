<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Comprobante de Venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Libreria Merry</h1>
            <h5>Dirección: Final Sexta Avenida Norte</h5>
            <h3>Comprobante de Venta</h3>
        </div>
        
        <p><strong>Nombre del Cliente:</strong> {{ $venta['nombre_cliente'] }}</p>
        <p><strong>Fecha de la Venta:</strong> {{ \Carbon\Carbon::parse($venta['fecha_venta'])->format('d/m/Y H:i') }}</p>
        
        <h3>Artículos</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Artículo</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta['articulos'] as $articulo)
                    <tr>
                        <td>{{ $articulo['nombre_producto'] }}</td>
                        <td>{{ $articulo['cantidad'] }}</td>
                        <td>{{ number_format($articulo['precio'], 2) }}</td>
                        <td>{{ number_format($articulo['subtotal'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <p><strong>Total:</strong> {{ number_format(array_sum(array_column($venta['articulos'], 'subtotal')), 2) }}</p>


        <div class="footer">
            <p>Gracias por su compra. Para consultas, llame al merrylibreria@gmail.com </p>
        </div>
    </div>
</body>
</html>
