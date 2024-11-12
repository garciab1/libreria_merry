<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Carbon\Carbon;

class EstadisticasController extends Controller
{
    protected $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function estadisticas()
    {
        // Obtener ventas y productos desde Firebase
        $ventas = $this->database->getReference('ventas')->getValue() ?? [];
        $productos = $this->database->getReference('productos')->getValue() ?? [];

        // Inicializar variables
        $gananciasDia = 0;
        $ventasDia = 0; // Variable para contar las ventas del día
        $gananciasMes = 0;
        $gananciasAno = 0; // Variable para las ganancias del año
        $fechaHoy = Carbon::now()->format('Y-m-d'); // Fecha de hoy (sin hora)
        $mesActual = Carbon::now()->format('Y-m'); // Mes actual
        $anoActual = Carbon::now()->format('Y'); // Año actual

        // Calcular ventas y ganancias del día, del mes y del año
        foreach ($ventas as $venta) {
            if (isset($venta['fecha_venta']) && isset($venta['total'])) {
                // Convertir la fecha de la venta a un objeto Carbon, ignorando la hora
                $fechaVenta = Carbon::parse($venta['fecha_venta'])->startOfDay()->format('Y-m-d'); // Eliminar la hora

                // Verificar si la venta es del día de hoy
                if ($fechaVenta === $fechaHoy) {
                    $gananciasDia += $venta['total']; // Sumar las ganancias de la venta
                    $ventasDia++; // Contar las ventas del día
                }

                // Verificar si la venta es del mes actual
                if (Carbon::parse($venta['fecha_venta'])->format('Y-m') === $mesActual) {
                    $gananciasMes += $venta['total']; // Sumar las ganancias del mes
                }

                // Verificar si la venta es del año actual
                if (Carbon::parse($venta['fecha_venta'])->format('Y') === $anoActual) {
                    $gananciasAno += $venta['total']; // Sumar las ganancias del año
                }
            }
        }

        // Calcular productos más vendidos y menos vendidos
        $productosVendidos = [];
        foreach ($ventas as $venta) {
            foreach ($venta['articulos'] as $articulo) {
                if (!isset($productosVendidos[$articulo['nombre']])) {
                    $productosVendidos[$articulo['nombre']] = 0;
                }
                $productosVendidos[$articulo['nombre']] += $articulo['cantidad'];
            }
        }

        // Ordenar productos más y menos vendidos
        arsort($productosVendidos); // Ordenar de mayor a menor
        $productosMasVendidos = array_slice($productosVendidos, 0, 5, true); // Primeros 5
        $productosMenosVendidos = array_slice($productosVendidos, -5, 5, true); // Últimos 5

        // Obtener productos con mayor y menor stock
        $stockProductos = [];
        foreach ($productos as $producto) {
            $stockProductos[$producto['nombre_producto']] = $producto['stock'];
        }

        // Ordenar productos por stock
        asort($stockProductos); // Menor a mayor
        $productosStockBajo = array_slice($stockProductos, 0, 5, true); // Primeros 5 (menos stock)

        arsort($stockProductos); // Mayor a menor
        $productosStockAlto = array_slice($stockProductos, 0, 5, true); // Primeros 5 (mayor stock)

        // Pasar variables a la vista
        return view('estadisticas', [
            'ventasDia' => $ventasDia,
            'gananciasDia' => $gananciasDia,
            'gananciasMes' => $gananciasMes,
            'gananciasAno' => $gananciasAno, // Pasamos las ganancias del año
            'productosMasVendidos' => $productosMasVendidos,
            'productosMenosVendidos' => $productosMenosVendidos,
            'productosStockBajo' => $productosStockBajo,
            'productosStockAlto' => $productosStockAlto,
        ]);
    }

}
