@extends('Firebase.ContactUser.appUser')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <h4 class="alert alert-warning mb-2">{{ session('status') }}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Productos 
                        <a href="{{ url('add-productUser') }}" class="btn btn-sm btn-primary float-end">Añadir producto</a>
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
                                <td>
                                    {{ $item['nombre_producto'] }}
                                    @if($item['stock'] <= 5)
                                        <span class="badge bg-danger">Stock crítico</span>
                                    @elseif($item['stock'] <= 10)
                                        <span class="badge bg-warning">Stock bajo</span>
                                    @elseif($item['stock'] <= 20)
                                        <span class="badge bg-success">Stock medio</span>
                                    @endif
                                </td>
                                <td>{{ $item['precio_unitario'] }}</td>
                                <td>{{ $item['stock'] }}</td>
                                <td>{{ $item['proveedor'] }}</td>
                                <td>{{ $item['categoria'] }}</td>
                                <td>{{ $item['descripcion'] }}</td>
                                <td>
                                    <button onclick="confirmEdit('{{ $key }}')" class="btn btn-warning btn-sm rounded-circle" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <span style="margin: 0 5px;"></span>
                                    <button onclick="confirmDeletion('{{ $key }}')" class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $key }}" action="{{ url('delete-productoUser/'.$key) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('searchProductInput').addEventListener('keyup', function() {
        var input = document.getElementById('searchProductInput').value.toLowerCase();
        var rows = document.querySelectorAll('#productTableBody tr');

        rows.forEach(row => {
            var cells = row.getElementsByTagName('td');
            var match = false;

            for (var i = 0; i < cells.length - 1; i++) {
                var cell = cells[i];
                if (cell.textContent.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? '' : 'none';
        });
    });

    function confirmEdit(id) {
        Swal.fire({
            title: '¿Deseas editar este producto?',
            text: "Serás redirigido a la página de edición",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'edit-productoUser/' + id;
            }
        });
    }

    function confirmDeletion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection
