<x-secciones-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Añadir usuario <a href="{{url('empleados2')}}" class="btn btn-sm btn-danger float-end">Volver</a></h4>
                    </div>
                    <div class="card-body">
                        <form id="userForm" class="needs-validation" action="{{url('/add-empleado')}}" method="POST" novalidate>
                            @csrf
        
                            <div class="form-group mb-3">
                                <label>Nombre:</label>
                                <input type="text" name="nombre_usuario" class="form-control" required>
                                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Apellido:</label>
                                <input type="text" name="apellido_usuario" class="form-control" required>
                                <div class="invalid-feedback">Por favor, ingrese el apellido.</div>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Teléfono:</label>
                                <input type="number" name="telefono" class="form-control" required>
                                <div class="invalid-feedback">Por favor, ingrese un teléfono válido.</div>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Fecha de nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                                <div class="invalid-feedback">Por favor, ingrese una fecha de nacimiento.</div>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Usuario:</label>
                                <input type="text" name="usuario" class="form-control" required>
                                <div class="invalid-feedback">Por favor, ingrese un nombre de usuario.</div>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Confirmar Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" id="password2" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">Por favor, confirme su contraseña.</div>
                                </div>
                                <div id="passwordError" class="text-danger" style="display: none;">
                                    Las contraseñas no coinciden.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.title = "Crear usuario";

            // Establece la fecha máxima en el campo de entrada
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('fechaNacimiento').setAttribute('max', today);

            // Mostrar/Ocultar Contraseña
            const togglePassword = document.getElementById('togglePassword');
            const togglePassword2 = document.getElementById('togglePassword2');
            const password = document.getElementById('password');
            const password2 = document.getElementById('password2');
            const passwordError = document.getElementById('passwordError');

            togglePassword.addEventListener('click', function () {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            togglePassword2.addEventListener('click', function () {
                const type = password2.type === 'password' ? 'text' : 'password';
                password2.type = type;
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            document.getElementById('userForm').addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();

                // Verifica si el formulario es válido
                if (this.checkValidity()) {
                    if (password.value !== password2.value) {
                        event.preventDefault();
                        passwordError.style.display = 'block';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Las contraseñas no coinciden.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        passwordError.style.display = 'none';

                        // Si todo está correcto, mostrar SweetAlert de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario agregado exitosamente',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            this.submit(); // Enviar el formulario si todo es válido
                        });
                    }
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
        });
    </script>

</x-secciones-layout>
