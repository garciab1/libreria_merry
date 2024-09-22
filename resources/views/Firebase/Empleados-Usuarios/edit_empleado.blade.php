<x-secciones-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Empleado 
                            <a href="{{url('empleados2')}}" class="btn btn-sm btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="editUserForm" class="needs-validation" action="{{url('update-empleado/'.$key)}}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
    
                            <!-- Modificación: Nombre y Apellido en la misma fila -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre_usuario" class="form-control" value="{{['name']}}" required>
                                    <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
                                </div>
    
                            </div>
    
                            <!-- Teléfono, Correo y Fecha de Nacimiento en la misma fila -->
                         
                            <hr>
                            <h5>Datos de la cuenta</h5>
    
                            <div class="row mb-3">

                            
                                <div class="col-md-4">
                                    <label>Usuario:</label>
                                    <input type="text" name="usuario" class="form-control" value="{{$editData['usuario']}}" required>
                                    <div class="invalid-feedback">Por favor, ingrese un nombre de usuario.</div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Email:</label>
                                    <input type="text" name="email" class="form-control" value="{{$editData['email']}}" required>
                                    <div class="invalid-feedback">Por favor, ingrese su correo electronico.</div>
                                </div>

    
                                <div class="col-md-4">
                                    <label>Contraseña:</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password" value="{{$editData['password']}}" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback">Por favor, ingrese una contraseña.</div>
                                </div>
    
                                <div class="col-md-4">
                                    <label>Confirmar Contraseña:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password2" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                    <div id="passwordError" class="text-danger" style="display: none;">
                                        Las contraseñas no coinciden.
                                    </div>
                                </div>
                            </div>
    
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Rol:</label>
                                    <select name="rol" class="form-control" required>
                                        
                                        <!-- Opción Administrador -->
                                        <option value="administrador" {{ strtolower($editData['rol']) == 'administrador' ? 'selected' : '' }}>
                                            ADMINISTRADOR
                                        </option>
                                        <!-- Opción Empleado -->
                                        <option value="empleado" {{ strtolower($editData['rol']) == 'empleado' ? 'selected' : '' }}>
                                            EMPLEADO
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, seleccione un rol.</div>
                                </div>
                            </div>
                            
    
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
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
            document.title = "Editar usuario";

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

            document.getElementById('editUserForm').addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();

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

                        // SweetAlert2 de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Usuario actualizado exitosamente',
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            this.submit(); // Enviar formulario si todo es válido
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
