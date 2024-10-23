@extends('Firebase.Contact.app')

@section('content')

<!-- Asegúrate de incluir el CSS de Bootstrap Icons aquí -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <h4 class="alert alert-success mb-2">{{ session('status') }}</h4>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Estadísticas</h4>
                    <a href="/inicio_admin" class="btn btn-primary">Volver</a>
                </div>
            </div>

            
            <div class="row mt-3">
                <!-- Ventas del día -->
                <div class="col-md-4">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-bag me-2"></i> Ventas del día
                            </h5>
                            <p class="card-text display-4"><strong>{{ $ventasDia }}</strong></p>
                        </div>
                    </div>
                </div>
                
                <!-- Ganancias de hoy -->
                <div class="col-md-4">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-wallet me-2"></i> Ganancias de hoy
                            </h5>
                            <p class="card-text display-4"><strong>${{ number_format($gananciasDia, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
                
                <!-- Ganancias este mes -->
                <div class="col-md-4">
                    <div class="card text-center bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-graph-up me-2"></i> Ganancias este mes
                            </h5>
                            <p class="card-text display-4"><strong>${{ number_format($gananciasMes, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parte de los gráficos -->
            <div class="row mt-5">
                <!-- Tarjeta: Productos más vendidos -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Productos más vendidos
                        </div>
                        <div class="card-body">
                            <canvas id="chartMasVendidos"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta: Productos menos vendidos -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            Productos menos vendidos
                        </div>
                        <div class="card-body">
                            <canvas id="chartMenosVendidos"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Tarjeta: Productos con mayor stock -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Productos con mayor stock
                        </div>
                        <div class="card-body">
                            <canvas id="chartMayorStock"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta: Productos con menor stock -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            Productos con menor stock
                        </div>
                        <div class="card-body">
                            <canvas id="chartMenorStock"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para los gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Productos más vendidos
    var ctxMasVendidos = document.getElementById('chartMasVendidos').getContext('2d');
    new Chart(ctxMasVendidos, {
        type: 'doughnut', 
        data: {
            labels: {!! json_encode(array_keys($productosMasVendidos)) !!},
            datasets: [{
                label: 'Ventas',
                data: {!! json_encode(array_values($productosMasVendidos)) !!},
                backgroundColor: getRandomColors({{ count($productosMasVendidos) }}),
            }]
        },
        options: {
            responsive: true
        }
    });

    // Productos menos vendidos
    var ctxMenosVendidos = document.getElementById('chartMenosVendidos').getContext('2d');
    new Chart(ctxMenosVendidos, {
        type: 'doughnut', 
        data: {
            labels: {!! json_encode(array_keys($productosMenosVendidos)) !!},
            datasets: [{
                data: {!! json_encode(array_values($productosMenosVendidos)) !!},
                backgroundColor: getRandomColors({{ count($productosMenosVendidos) }}),
            }]
        },
        options: {
            responsive: true
        }
    });

    // Productos con mayor stock
    var ctxMayorStock = document.getElementById('chartMayorStock').getContext('2d');
    new Chart(ctxMayorStock, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($productosStockAlto)) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode(array_values($productosStockAlto)) !!},
                backgroundColor: ['#27ae60', '#2ecc71', '#16a085'],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Productos con menor stock
    var ctxMenorStock = document.getElementById('chartMenorStock').getContext('2d');
    new Chart(ctxMenorStock, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($productosStockBajo)) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode(array_values($productosStockBajo)) !!},
                backgroundColor: ['#e74c3c', '#e67e22', '#f39c12'],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Función para generar colores aleatorios
    function getRandomColors(num) {
        const colors = [];
        for (let i = 0; i < num; i++) {
            const randomColor = `hsl(${Math.random() * 360}, 100%, 75%)`;
            colors.push(randomColor);
        }
        return colors;
    }
</script>
@endsection
