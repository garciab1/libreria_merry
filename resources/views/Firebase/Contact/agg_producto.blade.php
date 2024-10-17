<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<x-MenuAdmin>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Nuevo Producto</h1>
        <form id="productForm" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="productName" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="productName" name="nombre_producto" required>
                <div class="invalid-feedback">
                    Por favor, ingrese el nombre del producto.
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="price" class="form-label">Precio unitario</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="precio_unitario" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un precio válido.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la cantidad de stock.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="supplier" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" id="supplier" name="proveedor" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del proveedor.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-control" id="category" name="categoria" required>
                        <option value="" selected disabled>ELEGIR CATEGORÍA</option>
                        <option value="PAPELERÍA">PAPELERÍA</option>
                        <option value="OFICINA">OFICINA</option>
                        <option value="ARTE Y MANUALIDADES">ARTE Y MANUALIDADES</option>
                        <option value="ESCOLAR">ESCOLAR</option>
                        <option value="LIBROS">LIBROS</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione una categoría.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="descripcion" rows="4" required></textarea>
                <div class="invalid-feedback">
                    Por favor, ingrese una descripción del producto.
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success me-2">Agregar</button>
                <button type="button" class="btn btn-secondary me-2" onclick="cancelForm()">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('IniAdmin') }}'">Cerrar</button>
            </div>
            
    
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación del formulario y manejo de respuesta AJAX
        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (this.checkValidity()) {
                // Preparar datos del formulario
                const formData = new FormData(this);

                // Enviar datos usando AJAX
                fetch('{{ url("add-product") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Producto agregado exitosamente',
                            timer: 3000,
                            showConfirmButton: false
                        });
                        // Resetear el formulario
                        this.reset();
                        this.classList.remove('was-validated');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Ocurrió un problema al agregar el producto.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto agregado exitosamente',
                        text: 'El producto se agrego exitosamente',
                        timer: 3000,
                        showConfirmButton: false
                    });
                });
            } else {
                this.classList.add('was-validated');
                
                // Notificación de error usando SweetAlert2
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos obligatorios.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });

        // Lógica para el botón de cancelar
        function cancelForm() {
            const form = document.getElementById('productForm');
            form.reset();
            form.classList.remove('was-validated');

            // Notificación de cancelación usando SweetAlert2
            Swal.fire({
                icon: 'info',
                title: 'Formulario cancelado',
                text: 'Todos los campos han sido limpiados.',
                timer: 3000,
                showConfirmButton: false
            });
        }
    </script>
</x-MenuAdmin>
</body>

</html>
