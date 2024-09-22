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
                    <h4>Empleados 
                       
                        <input type="text" id="searchInput" class="form-control float-end ms-2" placeholder="Buscar..." style="max-width: 250px; margin-right: 15px;">
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
                                    <a href="{{url('edit-empleado/'.$key)}}" class="btn btn-warning btn-sm rounded-circle" title="Editar">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <span style="margin: 0 5px;"></span>
                                    <a href="{{url('delete-empleado/'.$key)}}" class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">No se encontraron empleados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


<Script>
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
</Script>


@endsection