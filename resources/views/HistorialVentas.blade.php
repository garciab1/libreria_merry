<x-secciones-layout>

    <h1 class="mb-4">Historial de ventas</h1>

    <div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>FECHA</th>
                    <th>CÓD. VENTA</th>
                    <th>CLIENTE</th>
                    <th>MONTO</th>
                    <th>DETALLES</th>
                </tr>
            </thead>
            <tbody id="modalListaFacturas">
                <!-- Aquí se llenarán las facturas generadas -->
                <!-- Registro 1 -->
                <tr>
                    <td>02/09/2024</td>
                    <td>00012</td>
                    <td>Juan Pérez</td>
                    <td>$23.84</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i> 
                        </button>
                    </td>
                </tr>
                <!-- Registros adicionales -->
                <tr>
                    <td>01/09/2024</td>
                    <td>00013</td>
                    <td>María Gómez</td>
                    <td>$50.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>31/08/2024</td>
                    <td>00014</td>
                    <td>Pedro Martínez</td>
                    <td>$15.75</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>30/08/2024</td>
                    <td>00015</td>
                    <td>Ana López</td>
                    <td>$60.20</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>29/08/2024</td>
                    <td>00016</td>
                    <td>Laura Fernández</td>
                    <td>$45.10</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>28/08/2024</td>
                    <td>00017</td>
                    <td>Antonio Ruiz</td>
                    <td>$27.90</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>27/08/2024</td>
                    <td>00018</td>
                    <td>Elena Romero</td>
                    <td>$33.25</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>26/08/2024</td>
                    <td>00019</td>
                    <td>Jorge Castillo</td>
                    <td>$78.60</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>25/08/2024</td>
                    <td>00020</td>
                    <td>Isabel Sánchez</td>
                    <td>$90.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-file-invoice"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        
        document.addEventListener("DOMContentLoaded", function() {
                document.title = "Historial";
            });
    </script>

</x-secciones-layout>
