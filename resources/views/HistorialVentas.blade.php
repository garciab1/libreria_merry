    @extends('Firebase.Contact.app')

    @section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
    
                @if(session('status'))
                    <h4 class="alert alert-success mb-2">{{ session('status') }}</h4>
                @endif
    
                <div class="card">
                    <div class="card-header">
                        <h4>Historial de Ventas
                            <input type="text" id="searchInput" class="form-control float-end ms-2" placeholder="Buscar ventas..." style="max-width: 250px;">
                        </h4>
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
                                                @if(isset($articulo['nombre_producto']))
                                                    {{ $articulo['nombre_producto'] }} ({{ $articulo['cantidad'] }} x ${{ $articulo['precio'] }})
                                                @else
                                                    Producto desconocido ({{ $articulo['cantidad'] }} x ${{ $articulo['precio'] }})
                                                @endif
                                            </li>
                                            @endforeach 
                                        </ul>
                                    </td>
                                    <td>${{ number_format($venta['total'], 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No se encontraron ventas registradas.</td>
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
    
                    // Revisar cada celda excepto la última (total)
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
