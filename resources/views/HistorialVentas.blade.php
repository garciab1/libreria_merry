@extends('Firebase.Contact.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <h4 class="alert alert-success mb-2">{{ session('status') }}</h4>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Historial de Ventas</h4>
                    <div class="d-flex align-items-center">
                        <input type="text" id="searchInput" class="form-control ms-2" placeholder="Buscar..." style="max-width: 250px; margin-right: 15px;">
                        <a href="/inicio_admin" class="btn btn-primary">Volver</a>
                    </div>
                </div>

                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Nombre del Cliente</th>
                                <th>Fecha de la Venta</th>
                                <th>Artículos</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="salesTableBody">
                            @forelse ($ventas as $key => $venta)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $venta['nombre_cliente'] }}</td>
                                <td>{{ $venta['fecha_venta'] }}</td>
                                <td>
                                    <ul>
                                        @foreach ($venta['articulos'] as $articulo)
                                        <li>
                                            {{ $articulo['nombre_producto'] ?? 'Producto desconocido' }} ({{ $articulo['cantidad'] }} x ${{ $articulo['precio'] }})
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>${{ number_format($venta['total'], 2) }}</td>
                                <td>
                                    <!-- Botón para imprimir el comprobante -->
                                    <a href="{{ route('RealizarVenta.imprimirComprobante', $key) }}" target="_blank" class="btn btn-success">
                                        Imprimir Comprobante
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No se encontraron ventas registradas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.title = "Historial de Ventas";

        const searchInput = document.getElementById('searchInput');
        const salesTableBody = document.getElementById('salesTableBody');
        const rows = salesTableBody.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const input = searchInput.value.toLowerCase();

            Array.from(rows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                let match = false;

                // Revisar cada celda excepto la última (acciones)
                for (let i = 0; i < cells.length - 1; i++) {
                    const cell = cells[i];
                    if (cell.textContent.toLowerCase().includes(input)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? '' : 'none';
            });
        });
    });
</script>

@endsection
