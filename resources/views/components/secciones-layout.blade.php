<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link rel="icon" href="{{asset('images/icono.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        {{$slot}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación del formulario y SweetAlert2
        document.getElementById('productForm').addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (this.checkValidity()) {
                // Notificación de éxito usando SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: '¡Se ha añadido exitosamente!',
                    timer: 3000,
                    showConfirmButton: false
                });

                // Resetear el formulario
                this.reset();
                this.classList.remove('was-validated');
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
</x-MenuUser>
</body>

</html>

