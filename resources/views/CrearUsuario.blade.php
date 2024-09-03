<x-secciones-layout>

    <h1 class="mb-4"><b>Crear Usuario</b></h1>
    <form id="productForm" class="needs-validation" novalidate>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" required>
                <div class="invalid-feedback">
                    Por favor, ingrese un nombre.
                </div>
            </div>
            <div class="col-md-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" required>
                <div class="invalid-feedback">
                    Por favor, ingrese el apellido.
                </div>
            </div>
            <div class="col-md-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" id="telefono" required>
                <div class="invalid-feedback">
                    Por favor, ingrese el número de teléfono.
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <!-- Fecha de Nacimiento -->
            <div class="form-group col-md-3">
                <label for="fechaNacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
            </div>
        </div>
        <hr>
        <h4><b>Datos de la cuenta</b></h4>
        
        <div class="row mb-3">
            <div class="form-group col-md-3 position-relative">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario">
            </div>
            <div class="form-group col-md-3 position-relative">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="form-group col-md-3 position-relative">
                <label for="password-confirm">Repetir contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password2" name="password2">
                    <span class="input-group-text" id="togglePassword2" style="cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <small id="passwordError" class="form-text text-danger" style="display: none;">Las contraseñas no coinciden.</small>
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary me-2">Agregar</button>
            <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancelar</button>
        </div>
    </form>

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

            document.getElementById('productForm').addEventListener('submit', function(event) {
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
