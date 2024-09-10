<x-secciones-layout>

    <h1 class="mb-4">Productos y Stock</h1>
    
    <div>
        
        <div class="py-3">
            @yield('content')
        </div>





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
