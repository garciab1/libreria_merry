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
                    <h4>Empleados <a href="{{url('add-empleado')}}" class="btn btn-sm btn-primary float-end">Añadir Empleado</a></h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <TH>APELLIDO</TH>
                            <th>TELÉFONO</th>
                            <th>FECHA NACIMIENTO</th>
                            <th>USUARIO</th>
                            <th>CONTRASEÑA</th>
                            <th>ROL</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @forelse ($usuarios as $key => $item)
                            
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item['nombre_usuario']}}</td>
                            <td>{{$item['apellido_usuario']}}</td>
                            <td>{{$item['telefono']}}</td>
                            <td>{{$item['fechaNacimiento']}}</td>
                            <td>{{$item['usuario']}}</td>
                            <td>{{$item['password']}}</td>
                            <td>{{$item['rol']}}</td>
                            <td>
                                <!-- Botón de Editar -->
                                <a href="{{url('edit-empleado/'.$key)}}" class="btn btn-warning btn-sm rounded-circle" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                
        
                                <!-- Espacio entre botones -->
                                <span style="margin: 0 5px;"></span>
        
                                <!-- Botón de Eliminar -->

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

<Script>
    document.addEventListener("DOMContentLoaded", function() {
                document.title = "Empleados";
            });
</Script>


@endsection