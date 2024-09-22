<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Libreria Merry</h1>
        <h5>Dirección: Final Sexta Avenidad Norte</h5>
        <h3><center>Comprobante de Venta<center></h3>
        <p><strong>Nombre del Cliente:</strong> {{ $venta['nombre_cliente'] }}</p>
        <p><strong>Fecha de la Venta:</strong> {{ $venta['fecha_venta'] }}</p>
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
        <p><strong>Total:</strong> {{ number_format($venta['total'], 2) }}</p>
        <button onclick="window.print();" class="btn btn-primary">Imprimir Comprobante</button>
    </div>
</body>
</html>
