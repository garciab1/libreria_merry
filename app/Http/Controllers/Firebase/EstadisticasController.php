<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

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
        $ventasDia = 0;
        $gananciasMes = 0;
        $fechaHoy = date('Y-m-d');
        $mesActual = date('Y-m');
    
        // Calcular ventas y ganancias del día y del mes
        foreach ($ventas as $venta) {
            $fechaVenta = date('Y-m-d', strtotime($venta['fecha_venta']));
            if ($fechaVenta === $fechaHoy) {
                $gananciasDia += $venta['total'];
                $ventasDia++;
            }
    
            // Verificar si la venta es del mes actual
            if (strpos($fechaVenta, $mesActual) === 0) {
                $gananciasMes += $venta['total'];
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
            'productosMasVendidos' => $productosMasVendidos,
            'productosMenosVendidos' => $productosMenosVendidos,
            'productosStockBajo' => $productosStockBajo,
            'productosStockAlto' => $productosStockAlto,
        ]);
    }
    
    

    

}
