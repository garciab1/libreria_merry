<x-MenuAdmin>
    <style>

        .tarjeta-efecto {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        
        .tarjeta-efecto:hover {
            transform: scale(1.05); /* Pequeño zoom */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Sombra más profunda al hacer hover */
        }
        /* Estilos básicos del título */
        h1 {
            font-size: 2.5rem; /* Tamaño del título */
            color: #333; /* Color inicial del texto */
            transition: color 0.3s ease, transform 0.3s ease; /* Transiciones suaves */
        }
        
        /* Efecto al pasar el puntero por encima */
        h1:hover {
            color: #142b4d; /* Cambia el color del título al pasar el puntero */
            transform: scale(1.1); /* Aumenta ligeramente el tamaño del título */
        }
            </style>
    <div class="text-center">
    <h1>
        <br><b>LIBRERÍA MERRY</b></h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Tarjeta 1 -->
            <div class="col-md-4 mb-4">
                <div class="card tarjeta-efecto">
                    <div class="card-body">
                        <img src="{{ asset('images/venta.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/realizarVentaAdmin" class="btn btn-primary">Realizar venta</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 2 -->
            <div class="col-md-4 mb-4">
                <div class="card tarjeta-efecto">
                    <div class="card-body">
                        <img src="{{ asset('images/producto.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/add-product" class="btn btn-primary">Nuevo producto</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 3 -->
            <div class="col-md-4 mb-4">
                <div class="card tarjeta-efecto">
                    <div class="card-body">
                        <img src="{{ asset('images/stock.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/productos" class="btn btn-primary">Productos y stock</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 4 -->
            <div class="col-md-4 mb-4">
                <div class="card tarjeta-efecto">
                    <div class="card-body">
                        <img src="{{ asset('images/historial.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="{{ route('HistorialVentas') }}" class="btn btn-primary">Historial de ventas</a>
                    </div>
                </div>
            </div>
    
            <!-- Tarjeta 5 -->
            <div class="col-md-4 mb-4">
                <div class="card tarjeta-efecto">
                    <div class="card-body">
                        <img src="{{ asset('images/empleado.png') }}" alt="Descripción de la imagen" width="100">
                        <br><br>
                        <a href="/empleados2" class="btn btn-primary">Empleados</a>
                    </div>
                </div>
            </div>
              
        </div>
    </div>
    </div>
</x-MenuAdmin>