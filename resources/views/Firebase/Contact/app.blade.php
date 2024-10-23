<x-secciones-layout>
        <div>
        
        <div class="py-3">
            @yield('content')
        </div>





    </div>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    </script>

</x-secciones-layout>
