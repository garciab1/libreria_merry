<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Venta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-secciones-layout>
<body>
    <div class="container-fluid centrar-contenido">
        <div class="formulario-venta">
            <h2 class="mb-4 text-left">Nueva Venta</h2>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('RealizarVenta.store') }}" id="formNuevaVenta">
                @csrf

                <div class="form-group">
                    <label for="nombre_cliente">Nombre del Cliente</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingrese el nombre del cliente" required>
                </div>

                <div class="form-group">
                    <label for="fecha_venta">Fecha de la Venta</label>
                    <input type="datetime-local" class="form-control" id="fecha_venta" name="fecha_venta" required>
                </div>

                <div class="form-group">
                    <label for="buscar_articulo">Buscar Artículos</label>
                    <input type="text" class="form-control" id="buscar_articulo" name="buscar_articulo" placeholder="Ingrese nombre o código del artículo">
                </div>

               <!-- Resultados de búsqueda en tiempo real -->
               <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre del Artículo</th>
                                <th>Disponibilidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="vista_previa_articulos"></tbody>
                    </table>
             </div>

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
                        <tbody id="lista_articulos"></tbody>
                    </table>
                </div>

                <div class="form-group mt-3">
                    <label for="total_venta">Total de la Venta</label>
                    <input type="text" class="form-control" id="total_venta" name="total_venta" readonly value="$0">
                </div>

                <input type="hidden" id="articulos" name="articulos" value="[]">

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success" id="realizar_venta_btn">Realizar Venta</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('IniAdmin') }}'">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal_resumen_venta" tabindex="-1" role="dialog" aria-labelledby="modalResumenVentaLabel" aria-hidden="true">
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
                        <tbody id="modalListaArticulos"></tbody>
                    </table>
                    <hr>
                    <p><strong>Total de la Venta:</strong> <span id="modalTotalVenta"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="imprimir_comprobante_btn">Imprimir Comprobante</button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Función para buscar artículos en tiempo real
        document.getElementById('buscar_articulo').addEventListener('input', function () {
            let articuloBuscado = this.value;

            if (articuloBuscado.trim() === '') {
                document.getElementById('vista_previa_articulos').innerHTML = ''; // Limpiar resultados si el campo está vacío
                return;
            }

            fetch('{{ route('RealizarVenta.buscarArticulo') }}?query=' + encodeURIComponent(articuloBuscado))
                .then(response => response.json())
                .then(data => {
                    let vistaPrevia = document.getElementById('vista_previa_articulos');
                    vistaPrevia.innerHTML = '';

                    if (data && Object.keys(data).length) {
                        Object.keys(data).forEach(key => {
                            let articulo = data[key];
                            let disponible = articulo.stock > 0 ? 'Disponible' : 'No disponible';
                            let botonAgregar = articulo.stock > 0 ? '' : 'disabled';

                            let nuevaFila = `
                                <tr>
                                    <td>${articulo.nombre_producto}</td>
                                    <td>${disponible}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm agregarArticulo" 
                                            data-id="${key}" 
                                            data-nombre="${articulo.nombre_producto}" 
                                            data-stock="${articulo.stock}" 
                                            data-precio="${articulo.precio_unitario}"
                                            ${botonAgregar}>
                                            Agregar
                                        </button>
                                    </td>
                                </tr>
                            `;
                            vistaPrevia.insertAdjacentHTML('beforeend', nuevaFila);
                        });
                    } else {
                        vistaPrevia.innerHTML = '<tr><td colspan="3" class="text-center">No se encontraron artículos.</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al buscar los artículos.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
        });


        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('agregarArticulo')) {
                let id = e.target.getAttribute('data-id');
                let nombre = e.target.getAttribute('data-nombre');
                let stock = parseInt(e.target.getAttribute('data-stock'));
                let precio = parseFloat(e.target.getAttribute('data-precio'));

                let listaArticulos = document.getElementById('lista_articulos');
                let nuevaFila = `
                    <tr>
                        <td>${id}</td>
                        <td>${nombre}</td>
                        <td>${stock}</td>
                        <td>${precio.toFixed(2)}</td>
                        <td><input type="number" class="form-control cantidadArticulo" min="1" max="${stock}" value="1"></td>
                        <td class="subtotal">${precio.toFixed(2)}</td>
                        <td><button type="button" class="btn btn-danger btn-sm eliminarArticulo">Eliminar</button></td>
                    </tr>
                `;
                listaArticulos.insertAdjacentHTML('beforeend', nuevaFila);
                actualizarTotal();
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('eliminarArticulo')) {
                e.target.closest('tr').remove();
                actualizarTotal();
            }
        });

        function actualizarTotal() {
            let total = 0;
            document.querySelectorAll('#lista_articulos .subtotal').forEach(subtotal => {
                total += parseFloat(subtotal.textContent);
            });
            document.getElementById('total_venta').value = `$${total.toFixed(2)}`;
        }

        document.addEventListener('input', function (e) {
            if (e.target && e.target.classList.contains('cantidadArticulo')) {
                let cantidad = parseInt(e.target.value);
                let precio = parseFloat(e.target.closest('tr').querySelector('td:nth-child(4)').textContent);
                let subtotal = e.target.closest('tr').querySelector('.subtotal');
                subtotal.textContent = (cantidad * precio).toFixed(2);
                actualizarTotal();
            }
        });

        document.getElementById('formNuevaVenta').addEventListener('submit', function () {
            let articulos = [];
            document.querySelectorAll('#lista_articulos tr').forEach(row => {
                let codigo = row.querySelector('td:nth-child(1)').textContent;
                let nombre = row.querySelector('td:nth-child(2)').textContent;
                let stock = row.querySelector('td:nth-child(3)').textContent;
                let precio = row.querySelector('td:nth-child(4)').textContent;
                let cantidad = row.querySelector('.cantidadArticulo').value;
                let subtotal = row.querySelector('.subtotal').textContent;

                articulos.push({
                    codigo: codigo,
                    nombre: nombre,
                    stock: stock,
                    precio: parseFloat(precio),
                    cantidad: parseInt(cantidad),
                    subtotal: parseFloat(subtotal)
                });
            });

            document.getElementById('articulos').value = JSON.stringify(articulos);
        });


        document.getElementById('formNuevaVenta').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el envío del formulario para poder ver el JSON
    
    let articulos = [];
    document.querySelectorAll('#lista_articulos tr').forEach(row => {
        let codigo = row.querySelector('td:nth-child(1)').textContent;
        let nombre = row.querySelector('td:nth-child(2)').textContent;
        let stock = row.querySelector('td:nth-child(3)').textContent;
        let precio = row.querySelector('td:nth-child(4)').textContent;
        let cantidad = row.querySelector('.cantidadArticulo').value;
        let subtotal = row.querySelector('.subtotal').textContent;

        articulos.push({
            codigo: codigo,
            nombre: nombre,
            stock: stock,
            precio: parseFloat(precio),
            cantidad: parseInt(cantidad),
            subtotal: parseFloat(subtotal)
        });
    });

    // Aquí imprimimos el JSON en la consola
        console.log(JSON.stringify(articulos, null, 2));

        document.getElementById('articulos').value = JSON.stringify(articulos);
        
        this.submit();
    });


    window.onload = function() 
    {
            const fechaActual = new Date();
            
            // Obtener los componentes de la fecha
            const year = fechaActual.getFullYear();
            const month = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Mes (añadir 0 si es necesario)
            const day = ('0' + fechaActual.getDate()).slice(-2); // Día (añadir 0 si es necesario)
            const hours = ('0' + fechaActual.getHours()).slice(-2); // Horas
            const minutes = ('0' + fechaActual.getMinutes()).slice(-2); // Minutos

            // Formatear la fecha en 'YYYY-MM-DDTHH:mm' para el campo datetime-local
            const fechaFormateada = `${year}-${month}-${day}T${hours}:${minutes}`;
            
            document.getElementById('fecha_venta').value = fechaFormateada;
    }

 </script>
</body>
</x-secciones-layout>

</html>
