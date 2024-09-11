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
                    <h4>Productos <a href="{{url('add-product')}}" class="btn btn-sm btn-primary float-end">Añadir producto</a></h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>PRODUCTO</th>
                            <th>PRECIO U.</th>
                            <th>STOCK</th>
                            <th>PROVEEDOR</th>
                            <th>CATEGORÍA</th>
                            <th>DESCRIPCIÓN</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $key => $item)
                            
                        <tr>
                            <td>{{$item['nombre_producto']}}</td>
                            <td>{{$item['precio_unitario']}}</td>
                            <td>{{$item['stock']}}</td>
                            <td>{{$item['proveedor']}}</td>
                            <td>{{$item['categoria']}}</td>
                            <td>{{$item['descripcion']}}</td>
                            <td><a href="" class="btn btn-sm btn-success">Editar</a></td>
                            <td><a href="" class="btn btn-sm btn-danger">Eliminar</a></td>
                            
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">No se encontraron artículos</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
                
            </div>

        </div>
    </div>
</div>


@endsection