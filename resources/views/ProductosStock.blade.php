<x-secciones-layout>

    <h1 class="mb-4">Productos y Stock</h1>
    <div class="mb-3 col-md-6 col-lg-4">
        <label for="productName" class="form-label">Buscar por nombre:</label> <br>
        <div class="input-group mb-6">
            <input type="search" id="searchInput" class="form-control" placeholder="Buscar" aria-label="Search" />
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>CÓDIGO</th>
                    <th>ARTÍCULO</th>
                    <th>PROVEEDOR</th>
                    <th>CATEGORÍA</th>
                    <th>STOCK</th>
                    <th>PRECIO U.</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="modalListaStock">
                <!-- Aquí se llenarán los artículos seleccionados -->
                <!-- Algunos elementos de relleno -->
                <tr>
                    <td>LIB001</td>
                    <td>El Quijote</td>
                    <td>Editorial Planeta</td>
                    <td>Novela</td>
                    <td>15</td>
                    <td>$20.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB002</td>
                    <td>Cien Años de Soledad</td>
                    <td>Editorial Sudamericana</td>
                    <td>Novela</td>
                    <td>10</td>
                    <td>$25.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB003</td>
                    <td>El Principito</td>
                    <td>Editorial Emece</td>
                    <td>Infantil</td>
                    <td>30</td>
                    <td>$15.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>OFI004</td>
                    <td>Lapicero Azul</td>
                    <td>BIC</td>
                    <td>Oficina</td>
                    <td>100</td>
                    <td>$0.20</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB005</td>
                    <td>1984</td>
                    <td>Editorial DeBolsillo</td>
                    <td>Distopía</td>
                    <td>20</td>
                    <td>$18.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB006</td>
                    <td>La Sombra del Viento</td>
                    <td>Editorial Planeta</td>
                    <td>Misterio</td>
                    <td>12</td>
                    <td>$24.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB007</td>
                    <td>La Odisea</td>
                    <td>Editorial Gredos</td>
                    <td>Clásico</td>
                    <td>7</td>
                    <td>$30.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>LIB008</td>
                    <td>Harry Potter y la Piedra Filosofal</td>
                    <td>Editorial Salamandra</td>
                    <td>Fantasía</td>
                    <td>25</td>
                    <td>$28.00</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="btn btn-danger btn-sm rounded-circle">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let input = this.value.toLowerCase();
            let tableRows = document.querySelectorAll('#modalListaStock tr');

            tableRows.forEach(function(row) {
                let rowText = row.textContent.toLowerCase();
                if (rowText.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
                document.title = "Productos Stock";
            });
    </script>

</x-secciones-layout>
