@extends('Firebase.Contact.app')

@section('title', 'Productos')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Nuevo producto
                        <a href="{{url('productos')}}" class="btn btn-sm btn-danger float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{url('add-product')}}" method="POST">
                        @csrf
                        
                        <div class="form group mb-3">
                            <label for="">Nombre:</label>
                            <input type="text" name="nombre_producto" class="form-control" style="text-transform: uppercase;">

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                              <label for="precio_unitario">Precio unitario $:</label>
                              <input type="number" name="precio_unitario" class="form-control" step="0.01" min="0">
                            </div>
                          
                            <div class="form-group col-md-6 mb-3">
                              <label for="stock">Stock:</label>
                              <input type="number" name="stock" class="form-control">
                            </div>
                        </div>
                          
                        

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                              <label for="proveedor">Proveedor:</label>
                              <input type="text" name="proveedor" class="form-control" style="text-transform: uppercase;">
                            </div>
                          
                            <div class="form-group col-md-6 mb-3">
                              <label for="categoria">Categoría:</label>
                              <select name="categoria" id="categoria" class="form-control">
                                <option value="" selected disabled>ELEGIR CATEGORÍA</option>
                                <option value="PAPELERÍA">PAPELERÍA</option>
                                <option value="OFICINA">OFICINA</option>
                                <option value="ARTE Y MANUALIDADES">ARTE Y MANUALIDADES</option>
                                <option value="ESCOLAR">ESCOLAR</option>
                                <option value="LIBROS">LIBROS</option>
                              </select>
                            </div>
                        </div>
                          
                          
                          <div class="form-group mb-3">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" placeholder="Escribe la descripción aquí..." style="text-transform: uppercase;"></textarea>
                          </div>
                          

                        <div class="form group mb-3">
                            
                            <button type="submit" class="btn btn-primary ">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
