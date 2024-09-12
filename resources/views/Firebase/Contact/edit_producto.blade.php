<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<x-MenuAdmin>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Editar Producto</h1>
        <form id="editProductForm" class="needs-validation" action="{{ url('update-producto/'.$key) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="productName" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="productName" name="nombre_producto" value="{{ $editData['nombre_producto'] }}" required>
                <div class="invalid-feedback">
                    Por favor, ingrese el nombre del producto.
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="price" class="form-label">Precio unitario</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="precio_unitario" value="{{ $editData['precio_unitario'] }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un precio válido.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $editData['stock'] }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la cantidad de stock.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="supplier" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" id="supplier" name="proveedor" value="{{ $editData['proveedor'] }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del proveedor.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-control" id="category" name="categoria" required>
                        <option value="" disabled>ELEGIR CATEGORÍA</option>
                        <option value="PAPELERÍA" {{ $editData['categoria'] == 'PAPELERÍA' ? 'selected' : '' }}>PAPELERÍA</option>
                        <option value="OFICINA" {{ $editData['categoria'] == 'OFICINA' ? 'selected' : '' }}>OFICINA</option>
                        <option value="ARTE Y MANUALIDADES" {{ $editData['categoria'] == 'ARTE Y MANUALIDADES' ? 'selected' : '' }}>ARTE Y MANUALIDADES</option>
                        <option value="ESCOLAR" {{ $editData['categoria'] == 'ESCOLAR' ? 'selected' : '' }}>ESCOLAR</option>
                        <option value="LIBROS" {{ $editData['categoria'] == 'LIBROS' ? 'selected' : '' }}>LIBROS</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione una categoría.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="descripcion" rows="4" required>{{ $editData['descripcion'] }}</textarea>
                <div class="invalid-feedback">
                    Por favor, ingrese una descripción del producto.
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                <a href="{{ url('productos') }}" class="btn btn-secondary">Cancelar</a> 
                <a href="{{ url('productos') }}" class="btn btn-sm btn-danger ">Volver</a> 
            
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación del formulario y manejo de respuesta AJAX
        document.getElementById('editProductForm').addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (this.checkValidity()) {
                // SweetAlert2 de éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Producto actualizado exitosamente',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    this.submit(); // Enviar formulario si todo es válido
                });
            } else {
                this.classList.add('was-validated');

                // SweetAlert de error si faltan campos
                Swal.fire({
                    icon: 'warning',
                    title: 'Error',
                    text: 'Por favor, complete todos los campos obligatorios.',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        });
    </script>
</x-MenuAdmin>
</body>

</html>
