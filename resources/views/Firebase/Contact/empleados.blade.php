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
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
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
                            <td><a href="" class="btn btn-sm btn-success">Editar</a></td>
                            <td><a href="" class="btn btn-sm btn-danger">Eliminar</a></td>
                            
                            
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