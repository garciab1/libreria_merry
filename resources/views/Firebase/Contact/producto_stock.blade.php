@extends('Firebase.Contact.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <h4 class="alert alert-warning mb-2">{{session('status')}}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Productos 
                        <a href="{{url('add-product')}}" class="btn btn-sm btn-primary float-end">Añadir producto</a>
                        <input type="text" id="searchProductInput" class="form-control float-end ms-2" placeholder="Buscar..." style="max-width: 250px; margin-right: 15px;">
                    </h4>
                </div>
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>PRODUCTO</th>
                                <th>PRECIO U.</th>
                                <th>STOCK</th>
                                <th>PROVEEDOR</th>
                                <th>CATEGORÍA</th>
                                <th>DESCRIPCIÓN</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            @forelse ($productos as $key => $item)
                            <tr>
                                <td>{{$item['nombre_producto']}}</td>
                                <td>{{$item['precio_unitario']}}</td>
                                <td>{{$item['stock']}}</td>
                                <td>{{$item['proveedor']}}</td>
                                <td>{{$item['categoria']}}</td>
                                <td>{{$item['descripcion']}}</td>
                                <td>
                                    <a href="{{url('edit-producto/'.$key)}}" class="btn btn-warning btn-sm rounded-circle" title="Editar">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <span style="margin: 0 5px;"></span>
                                    <a href="{{url('delete-producto/'.$key)}}" class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No se encontraron artículos</td>
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
    document.getElementById('searchProductInput').addEventListener('keyup', function() {
        var input = document.getElementById('searchProductInput').value.toLowerCase();
        var rows = document.querySelectorAll('#productTableBody tr');

        rows.forEach(row => {
            var cells = row.getElementsByTagName('td');
            var match = false;

            for (var i = 0; i < cells.length - 1; i++) { // Excluir la última celda con opciones
                var cell = cells[i];
                if (cell.textContent.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? '' : 'none';
        });
    });
</script>

@endsection
