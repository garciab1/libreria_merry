@extends('Firebase.Contact.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <h4 class="alert alert-warning mb-2">{{ session('status') }}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center">
                        Empleados
                        <div class="d-flex align-items-center">
                            <input type="text" id="searchInput" class="form-control ms-2" placeholder="Buscar..." style="max-width: 250px; margin-right: 15px;">
                            <a href="/inicio_admin" class="btn btn-primary">Volver</a>
                        </div>
                    </h4>
                </div>
                
                <div style="max-height: 400px; overflow-y: auto;"> <!-- Scroll con altura limitada -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>                              
                                <th>EMAIL</th>
                                <th>CONTRASEÑA</th>
                                <th>ROL</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($users as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['password'] }}</td>
                                <td>{{ $item['rol'] }}</td>
                                <td>
                                    <!-- Botones de Editar y Eliminar -->
                                    <button onclick="confirmEdit('{{ $key }}')" class="btn btn-warning btn-sm rounded-circle" title="Editar">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <span style="margin: 0 5px;"></span>
                                    <button onclick="confirmDeletion('{{ $key }}')" class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $key }}" action="{{ url('delete-empleado/'.$key) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No se encontraron empleados</td>
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
    document.addEventListener("DOMContentLoaded", function() {
        document.title = "Empleados";
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = document.getElementById('searchInput').value.toLowerCase();
        var rows = document.querySelectorAll('#employeeTableBody tr');

        rows.forEach(row => {
            var cells = row.getElementsByTagName('td');
            var match = false;

            for (var i = 0; i < cells.length - 1; i++) { // Exclude the last cell with options
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
            title: '¿Deseas editar este empleado?',
            text: "Serás redirigido a la página de edición",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'edit-empleado/' + id;
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
