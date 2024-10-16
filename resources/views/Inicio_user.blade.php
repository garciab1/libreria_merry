<x-MenuUser>
    <style>
        .tarjeta-efecto {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .tarjeta-efecto:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            background-color: #007bff;
            text-decoration: none;
        }

        .tarjeta-efecto img {
            transition: filter 0.3s ease;
            filter: grayscale(100%) !important;
        }

        .tarjeta-efecto:hover img {
            filter: grayscale(0%) !important;
        }

        .tarjeta-efecto h5 {
            color: #333;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .tarjeta-efecto:hover h5 {
            color: white;
            text-decoration: none;
        }

        h1 {
            font-size: 2.5rem;
            color: #333;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        h1:hover {
            color: #142b4d;
            transform: scale(1.1);
        }
    </style>

    <div class="text-center">
        <h1><br><b>LIBRERÍA MERRY</b></h1>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <!-- Tarjeta 1 -->
                <div class="col-md-4 mb-4">
                    <a href="/realizarVentaUser" class="tarjeta-efecto d-block">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/nuevos/venta-color.png') }}" alt="Descripción de la imagen" width="100">
                            <br><br>
                            <h5>Realizar venta</h5>
                        </div>
                    </a>
                </div>

                <!-- Tarjeta 2 -->
                <div class="col-md-4 mb-4">
                    <a href="/add-productUser" class="tarjeta-efecto d-block">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/nuevos/nuevo-producto-color.png') }}" alt="Descripción de la imagen" width="100">
                            <br><br>
                            <h5>Nuevo producto</h5>
                        </div>
                    </a>
                </div>

                <!-- Tarjeta 3 -->
                <div class="col-md-4 mb-4">
                    <a href="/productosUser" class="tarjeta-efecto d-block">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/nuevos/stock-color.png') }}" alt="Descripción de la imagen" width="100">
                            <br><br>
                            <h5>Productos y stock</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-MenuUser>
