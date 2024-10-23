<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="icon" href="{{asset('images/icono.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .btn-primary {
            background-color: #0e2238; 
            border-color: #0e2238; 
        }

        .btn-primary:hover {
            background-color: #4a4948; 
            border-color: #4a4948; 
        }

        .sidebar-link:hover {
        text-decoration: none; 
    }
        
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="{{asset('images/icono.png')}}" alt="" style="height: 30px">
                </button>
                <div class="sidebar-logo">
                    <a href="{{ route('IniAdmin') }}">Libreria Merry</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <img src="{{ session('user_avatar') }}" alt="Avatar" style="width: 25px; height: 25px; border-radius: 50%;">
                        <i></i>
                        <span>{{ session('user_name') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/realizarVentaAdmin" class="sidebar-link">
                        <i class="bi bi-cart icono"></i>
                        <span>Realizar venta</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/productos" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-ruler-pencil icono"></i>
                        <span>Productos</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/add-product" class="sidebar-link">Nuevo Producto</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/productos" class="sidebar-link">Productos y Stock</a>
                        </li>
                    </ul>
                </li>
               
                <li class="sidebar-item">
                    <a href="{{ route('HistorialVentas') }}" class="sidebar-link">
                        <i class="lni lni-hourglass icono"></i>
                        <span>Historial de ventas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/empleados2" class="sidebar-link">
                        <i class="lni lni-briefcase icono"></i>
                        <span>Empleados</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/estadisticas" class="sidebar-link">
                        <i class="bi bi-clipboard-data icono"></i>
                        <span>Estadísticas</span>
                    </a>
                </li>
               
            </ul>
            <div class="sidebar-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="lni lni-exit icono"></i>
                    <span>Cerrar sesión</span>
                </a>
            </div>
            

            <i class="lni lni-exit icono"></i>
        </aside>
        <div class="main p-3">
            <div class="">

              {{$slot}}     
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>