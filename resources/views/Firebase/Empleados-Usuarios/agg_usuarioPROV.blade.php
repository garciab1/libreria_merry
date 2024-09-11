<x-secciones-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Añadir usuario <a href="{{url('empleados2')}}" class="btn btn-sm btn-danger float-end">Volver</a></h4>
                    </div>
                    <div class="card-body">
                        <form id="userForm" action="{{url('/add-empleado')}}" method="POST">
                            @csrf
        
                            <div class="form-group mb-3">
                                <label>Nombre:</label>
                                <input type="text" name="nombre_usuario" class="form-control" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Apellido:</label>
                                <input type="text" name="apellido_usuario" class="form-control" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Teléfono:</label>
                                <input type="number" name="telefono" class="form-control" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Fecha de nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Usuario:</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
        
                            <div class="form-group mb-3">
                                <label>Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Confirmar Contraseña:</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation" class="form-control" id="password2" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                        <i class="fa fa-eye"></i>
                                    </button>
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
                // Alternar entre mostrar y ocultar la contraseña
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            togglePassword2.addEventListener('click', function () {
                // Alternar entre mostrar y ocultar la contraseña
                const type = password2.type === 'password' ? 'text' : 'password';
                password2.type = type;
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            document.getElementById('userForm').addEventListener('submit', function(event) {
                if (password.value !== password2.value) {
                    event.preventDefault(); // Previene el envío del formulario
                    passwordError.style.display = 'block'; // Muestra el mensaje de error
                } else {
                    passwordError.style.display = 'none'; // Oculta el mensaje de error
                }
            });
        });
    </script>

</x-secciones-layout>
