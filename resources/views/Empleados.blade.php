<x-secciones-layout>

    <h1 class="mb-4">Empleados</h1>

    <div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>USUARIO</th>
                    <th>EDAD</th>
                    <th>TELÉFONO</th>
                    <th>ROL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="modalListaFacturas">
                <!-- Registros de empleados / usuarios -->
                <tr>
                    <td>01</td>
                    <td>Administrador</td>
                    <td>admin</td>
                    <td>21</td>
                    <td>7553-2312</td>
                    <td>Admin</td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-warning btn-sm rounded-circle" title="Editar"
                                disabled style="opacity: 0.5; cursor: not-allowed;">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <!-- Espacio entre botones -->
                        <span style="margin: 0 5px;"></span>

                        <!-- Botón de Eliminar -->
                        <button class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>02</td>
                    <td>Ana Gomez</td>
                    <td>ana.gomez</td>
                    <td>30</td>
                    <td>7553-1234</td>
                    <td>Cajero</td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-warning btn-sm rounded-circle" title="Editar">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <!-- Espacio entre botones -->
                        <span style="margin: 0 5px;"></span>

                        <!-- Botón de Eliminar -->
                        <button class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>03</td>
                    <td>Carlos Rodriguez</td>
                    <td>carlos.rodriguez1</td>
                    <td>28</td>
                    <td>7553-5678</td>
                    <td>Empleado</td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-warning btn-sm rounded-circle" title="Editar">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <!-- Espacio entre botones -->
                        <span style="margin: 0 5px;"></span>

                        <!-- Botón de Eliminar -->
                        <button class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>04</td>
                    <td>Maria Fernandez</td>
                    <td>maria.fernandez</td>
                    <td>35</td>
                    <td>7553-8765</td>
                    <td>Empleado</td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-warning btn-sm rounded-circle" title="Editar">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <!-- Espacio entre botones -->
                        <span style="margin: 0 5px;"></span>

                        <!-- Botón de Eliminar -->
                        <button class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>05</td>
                    <td>Laura Martinez</td>
                    <td>laura.martinez</td>
                    <td>22</td>
                    <td>7553-2345</td>
                    <td>Admin</td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-warning btn-sm rounded-circle" title="Editar"
                                disabled style="opacity: 0.5; cursor: not-allowed;">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <!-- Espacio entre botones -->
                        <span style="margin: 0 5px;"></span>

                        <!-- Botón de Eliminar -->
                        <button class="btn btn-danger btn-sm rounded-circle" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.title = "Empleados";
        });
    </script>

</x-secciones-layout>
