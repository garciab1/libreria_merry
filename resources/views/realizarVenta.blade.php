<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .centrar-contenido {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .formulario-venta {
            width: 100%;
            max-width: 800px;
        }

        /* Responsivo para pantallas pequeñas */
        @media (max-width: 576px) {
            .formulario-venta {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <x-MenuUser>
        <div class="container-fluid centrar-contenido">
            <div class="formulario-venta">
                <!-- Título -->
                <h2 class="mb-4 text-left">Nueva Venta</h2>

                <!-- Mostrar mensajes de éxito o error -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Formulario de Nueva Venta -->
                <form method="POST" action="">
                    @csrf

                    <!-- Nombre del Cliente -->
                    <div class="form-group">
                        <label for="nombreCliente">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente"
                            placeholder="Ingrese el nombre del cliente">
                    </div>

                    <!-- Fecha de la Venta -->
                    <div class="form-group">
                        <label for="fechaVenta">Fecha de la Venta</label>
                        <input type="date" class="form-control" id="fechaVenta" name="fechaVenta">
                    </div>

                    <!-- Buscar Artículos -->
                    <div class="form-group">
                        <label for="buscarArticulo">Buscar Artículos</label>
                        <input type="text" class="form-control" id="buscarArticulo" name="buscarArticulo"
                            placeholder="Ingrese nombre o código del artículo">
                    </div>

                    <!-- Botón para buscar artículo -->
                    <button type="button" class="btn btn-secondary mb-3" id="buscarArticuloBtn">Buscar Artículo</button>

                    <!-- Tabla de Vista Previa de Artículos -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablaVistaPrevia">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre del Artículo</th>
                                    <th>Disponibilidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="vistaPreviaArticulos">
                                <!-- Aquí se mostrarán los resultados de búsqueda de artículos -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabla de Artículos Agregados -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre del Artículo</th>
                                    <th>Stock</th>
                                    <th>Precio Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaArticulos">
                                <!-- Aquí se agregarán dinámicamente los artículos seleccionados -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Botón para guardar la venta -->
                    <button type="submit" class="btn btn-success">Realizar Venta</button>
                </form>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies (Popper and jQuery) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            document.getElementById('buscarArticuloBtn').addEventListener('click', function () {
                // Obtener el valor del campo de búsqueda de artículos
                let articuloBuscado = document.getElementById('buscarArticulo').value;

                // Aquí puedes agregar la lógica para buscar el artículo en tu base de datos o lista
                // Simulación de resultados de búsqueda
                let resultados = [
                    { nombre: 'Cuadernos', disponibilidad: 'Disponible' },
                    { nombre: 'Crayolas', disponibilidad: 'No disponible' }
                ];

                // Limpiar la tabla de vista previa antes de agregar nuevos resultados
                let vistaPrevia = document.getElementById('vistaPreviaArticulos');
                vistaPrevia.innerHTML = '';

                // Llenar la tabla de vista previa con los resultados de búsqueda
                resultados.forEach(function (articulo) {
                    let nuevaFila = `
                        <tr>
                            <td>${articulo.nombre}</td>
                            <td>${articulo.disponibilidad}</td>
                            <td>
                            <button type="button" class="btn btn-primary btn-sm agregarArticulo" data-nombre="${articulo.nombre}">Agregar</button>
                            </td>
                        </tr>
                    `;
                    vistaPrevia.insertAdjacentHTML('beforeend', nuevaFila);
                });
            });

            // Evento para agregar artículo desde la vista previa a la tabla de artículos seleccionados
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('agregarArticulo')) {
                    let nombreArticulo = event.target.getAttribute('data-nombre');

                    // Aquí puedes agregar la lógica para obtener los detalles del artículo y su disponibilidad
                    // Simulación de agregar un artículo a la tabla de artículos seleccionados
                    let nuevaFila = `
                        <tr>
                            <td>001</td>
                            <td>${nombreArticulo}</td>
                            <td>50</td>
                            <td>$100</td>
                            <td><input type="number" value="1" class="form-control"></td> 
                            <td>$100</td>
                            <td><button type="button" class="btn btn-danger btn-sm eliminarArticulo">Eliminar</button></td>
                        </tr>
                    `;
                    //Falta validar que los números no sean negativos

                    document.getElementById('listaArticulos').insertAdjacentHTML('beforeend', nuevaFila);
                }

                // Lógica para manejar la eliminación de artículos de la tabla de artículos seleccionados
                if (event.target && event.target.classList.contains('eliminarArticulo')) {
                    event.target.closest('tr').remove();
                }
            });
        </script>
    </x-MenuUser>
</body>

</html>
