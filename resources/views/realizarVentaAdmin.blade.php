<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Venta</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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
    <x-MenuAdmin>
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
                <form method="POST" action="" id="formNuevaVenta">
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

                    <!-- Campo para el Total de la Venta -->
                    <div class="form-group mt-3">
                        <label for="totalVenta">Total de la Venta</label>
                        <input type="text" class="form-control" id="totalVenta" name="totalVenta" readonly value="$0">
                    </div>

                    <!-- Botones para guardar o cancelar la venta -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-success" id="realizarVentaBtn">Realizar Venta</button>
                        <button type="button" class="btn btn-danger" id="cancelarVentaBtn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de Resumen de Venta -->
        <div class="modal fade" id="modalResumenVenta" tabindex="-1" role="dialog" aria-labelledby="modalResumenVentaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalResumenVentaLabel">Resumen de la Venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre del Cliente:</strong> <span id="modalNombreCliente"></span></p>
                        <p><strong>Fecha de la Venta:</strong> <span id="modalFechaVenta"></span></p>
                        <hr>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nombre del Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="modalListaArticulos">
                                <!-- Aquí se llenarán los artículos seleccionados -->
                            </tbody>
                        </table>
                        <hr>
                        <p><strong>Total de la Venta:</strong> <span id="modalTotalVenta"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="imprimirComprobanteBtn">Imprimir Comprobante</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies (Popper and jQuery) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <script>
            function validarFormulario() {
                let nombreCliente = document.getElementById('nombreCliente').value.trim();
                let fechaVenta = document.getElementById('fechaVenta').value;
                let listaArticulos = document.getElementById('listaArticulos').children.length > 0;

                if (!nombreCliente) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo Requerido',
                        text: 'El nombre del cliente es obligatorio.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    return false;
                }

                if (!fechaVenta) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campo Requerido',
                        text: 'La fecha de la venta es obligatoria.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    return false;
                }

                if (!listaArticulos) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Artículos Vacíos',
                        text: 'Debes agregar al menos un artículo a la venta.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    return false;
                }

                return true;
            }

            function llenarResumenVenta() {
                // Obtener datos del formulario y de la tabla de artículos
                let nombreCliente = document.getElementById('nombreCliente').value;
                let fechaVenta = document.getElementById('fechaVenta').value;
                let listaArticulos = document.getElementById('listaArticulos').children;
                let totalVenta = document.getElementById('totalVenta').value;

                // Llenar el modal con la información
                document.getElementById('modalNombreCliente').textContent = nombreCliente;
                document.getElementById('modalFechaVenta').textContent = fechaVenta;

                let modalListaArticulos = document.getElementById('modalListaArticulos');
                modalListaArticulos.innerHTML = ''; // Limpiar tabla antes de agregar nuevos datos

                Array.from(listaArticulos).forEach(function (fila) {
                    let nombreArticulo = fila.children[1].textContent;
                    let cantidad = fila.children[4].querySelector('.cantidadArticulo').value;
                    let precioUnidad = fila.children[3].textContent;
                    let subtotal = fila.children[5].textContent;

                    let nuevaFila = `
                        <tr>
                            <td>${nombreArticulo}</td>
                            <td>${cantidad}</td>
                            <td>${precioUnidad}</td>
                            <td>${subtotal}</td>
                        </tr>
                    `;
                    modalListaArticulos.insertAdjacentHTML('beforeend', nuevaFila);
                });

                document.getElementById('modalTotalVenta').textContent = totalVenta;
            }

            document.getElementById('buscarArticuloBtn').addEventListener('click', function () {
                // Obtener el valor del campo de búsqueda de artículos
                let articuloBuscado = document.getElementById('buscarArticulo').value;

                // Aquí puedes agregar la lógica para buscar el artículo en tu base de datos o lista
                // Simulación de resultados de búsqueda
                let resultados = [
                    { nombre: 'Artículo 1', disponibilidad: 'Disponible' },
                    { nombre: 'Artículo 2', disponibilidad: 'No disponible' }
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
                            <td><button type="button" class="btn btn-primary btn-sm agregarArticulo" data-nombre="${articulo.nombre}">Agregar</button></td>
                        </tr>
                    `;
                    vistaPrevia.insertAdjacentHTML('beforeend', nuevaFila);
                });
            });

            // Evento para agregar artículo desde la vista previa a la tabla de artículos seleccionados
            document.addEventListener('click', function (event) {
                if (event.target && event.target.classList.contains('agregarArticulo')) {
                    let nombreArticulo = event.target.getAttribute('data-nombre');

                    // Simulación de agregar un artículo a la tabla de artículos seleccionados
                    let nuevaFila = `
                        <tr>
                            <td>001</td>
                            <td>${nombreArticulo}</td>
                            <td>50</td>
                            <td>100</td>
                            <td><input type="number" value="1" class="form-control cantidadArticulo" min="1"></td>
                            <td class="subtotal">$100</td>
                            <td><button type="button" class="btn btn-danger btn-sm eliminarArticulo">Eliminar</button></td>
                        </tr>
                    `;

                    document.getElementById('listaArticulos').insertAdjacentHTML('beforeend', nuevaFila);

                    // Recalcular el total
                    recalcularTotal();
                }

                // Lógica para manejar la eliminación de artículos de la tabla de artículos seleccionados
                if (event.target && event.target.classList.contains('eliminarArticulo')) {
                    event.target.closest('tr').remove();
                    recalcularTotal();
                }
            });

            // Función para recalcular el total de la venta
            function recalcularTotal() {
                let total = 0;
                document.querySelectorAll('#listaArticulos .subtotal').forEach(function (subtotal) {
                    total += parseFloat(subtotal.textContent.replace('$', ''));
                });
                document.getElementById('totalVenta').value = '$' + total.toFixed(2);
            }

            // Evento para manejar el botón "Cancelar"
            document.getElementById('cancelarVentaBtn').addEventListener('click', function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Venta Cancelada',
                    text: 'La venta ha sido cancelada.',
                    timer: 3000,
                    showConfirmButton: false
                });

                // Limpiar campos y tablas
                document.getElementById('formNuevaVenta').reset();
                document.getElementById('vistaPreviaArticulos').innerHTML = '';
                document.getElementById('listaArticulos').innerHTML = '';
                document.getElementById('totalVenta').value = '$0';
            });

            // Evento para manejar el botón "Realizar Venta"
            document.getElementById('realizarVentaBtn').addEventListener('click', function (event) {
                if (!validarFormulario()) {
                    event.preventDefault();
                    return;
                }

                llenarResumenVenta();

                // Mostrar el modal con el resumen de la venta
                $('#modalResumenVenta').modal('show');

                // Prevenir el envío del formulario para la demostración
                event.preventDefault();
            });

            document.getElementById('imprimirComprobanteBtn').addEventListener('click', function () {
                // Aquí puedes agregar la lógica para imprimir el comprobante
                window.print();
            });
        </script>
    </x-MenuAdmin>
</body>

</html>
