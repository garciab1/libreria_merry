<x-MenuAdmin>
    <div class="text-center">
    <h1>
        <br>LIBRERIA MERRY</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Tarjeta 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/venta.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/realizarVentaAdmin" class="btn btn-primary">Realizar venta</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/producto.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/AgregarProductoAdmin" class="btn btn-primary">Nuevo producto</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/stock.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="{{ route('ProductosStock') }}" class="btn btn-primary">Productos y stock</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 4 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/historial.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="{{ route('HistorialVentas') }}" class="btn btn-primary">Historial de ventas</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 5 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/empleado.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="{{ route('Empleados') }}" class="btn btn-primary">Empleados</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 6 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/usuario.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="{{ route('CrearUsuario')}}" class="btn btn-primary">Crear Usuario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-MenuAdmin>