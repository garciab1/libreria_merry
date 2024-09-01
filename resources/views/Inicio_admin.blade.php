<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio admin</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
    <style>
        /* Sobrescribir estilos de btn-primary */
        .btn-primary {
            background-color: #0e2238; /* Color de fondo personalizado (Tomato) */
            border-color: #0e2238; /* Borde personalizado */
        }

        .btn-primary:hover {
            background-color: #4a4948; /* Color de fondo al pasar el ratón (OrangeRed) */
            border-color: #4a4948; /* Borde al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Libreria Merry</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-coin"></i>
                        <span>Realizar venta</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-ruler-pencil"></i>
                        <span>Productos</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Nuevo Producto</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Productos y Stock</a>
                        </li>
                    </ul>
                </li>
                <!--
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Usuarios</span>
                    </a>
                 <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Administrar usuarios
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-hourglass"></i>
                        <span>Historial de ventas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-briefcase"></i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Administrar usuarios</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="/" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Cerrar sesión</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
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
                                    <a href="realizarVentaAdmin" class="btn btn-primary">Realizar venta</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Tarjeta 2 -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('images/producto.png') }}" alt="Descripción de la imagen" width="100">
                                    <br><br>
                                    <a href="#" class="btn btn-primary">Nuevo producto</a>
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
                
                        <!-- Tarjeta 4 -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('images/historial.png') }}" alt="Descripción de la imagen" width="100">
                                    <br><br>
                                    <a href="#" class="btn btn-primary">Historial de ventas</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Tarjeta 5 -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('images/empleado.png') }}" alt="Descripción de la imagen" width="100">
                                    <br><br>
                                    <a href="#" class="btn btn-primary">Empleados</a>
                                </div>
                            </div>
                        </div>
                
                        <!-- Tarjeta 6 -->
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('images/usuario.png') }}" alt="Descripción de la imagen" width="100">
                                    <br><br>
                                    <a href="#" class="btn btn-primary">Crear Usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>