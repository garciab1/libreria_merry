<x-secciones-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Empleado 
                            <a href="{{ url('empleados2') }}" class="btn btn-sm btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="editUserForm" class="needs-validation" action="{{ url('update-empleado/'.$key) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <!-- Campo solo de lectura: Nombre -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre_usuario" class="form-control" value="{{ $editData['name'] }}" readonly>
                                </div>
                            </div>

                            <!-- Campo solo de lectura: Email -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Email:</label>
                                    <input type="text" name="email" class="form-control" value="{{ $editData['email'] }}" readonly>
                                </div>
                            </div>

                            <!-- Campo solo de lectura: Contraseña -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Contraseña:</label>
                                    <input type="password" name="password" class="form-control" value="{{ $editData['password'] }}" readonly>
                                </div>
                            </div>

                            <hr>
                            <h5>Datos de la cuenta</h5>

                            <!-- Campo editable: Rol -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Rol:</label>
                                    <select name="rol" class="form-control" required>
                                        <option value="admin" {{ strtolower($editData['rol']) == 'admin' ? 'selected' : '' }}>
                                            ADMINISTRADOR
                                        </option>
                                        <option value="user" {{ strtolower($editData['rol']) == 'user' ? 'selected' : '' }}>
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
</x-secciones-layout>
