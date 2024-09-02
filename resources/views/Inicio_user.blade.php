<x-MenuUser>
    <div class="text-center">
    <h1>
        <br>LIBRERIA MERRY</h1>
        <br><br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Tarjeta 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/venta.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/realizarVenta" class="btn btn-primary">Realizar venta</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/producto.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/AgregarProducto" class="btn btn-primary">Nuevo producto</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('images/stock.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="#" class="btn btn-primary">Productos y stock</a>
                    </div>
                </div>
            </div>
    
   
        </div>
    </div>
    </div>
</x-MenuUser>