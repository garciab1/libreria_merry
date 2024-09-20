<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RealizarVentaController extends Controller
{
    protected $database;
    protected $tablaProductos;
    protected $tablaVentas;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablaProductos = 'productos';
        $this->tablaVentas = 'ventas';
    }

    public function index()
    {
        return view('realizarVentaAdmin');
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'nombre_cliente' => 'required|string|max:255',
        'fecha_venta' => 'required|date_format:Y-m-d\TH:i',  // Formato para datetime-local
        'articulos' => 'required|json'  // Aseguramos que se envíen los artículos como JSON
    ]);

    // Decodificar los artículos del JSON
    $articulos = json_decode($request->input('articulos'), true);
    
    // Verificar si la lista de artículos está vacía
    if (empty($articulos)) {
        return redirect()->route('RealizarVenta.index')->with('status', 'No se han agregado artículos a la venta.');
    }

    // Calcular el total sumando los subtotales de cada artículo
    $totalVenta = array_sum(array_column($articulos, 'subtotal'));

    // Preparar los datos de la venta
    $ventaData = [
        'nombre_cliente' => strtoupper($request->input('nombre_cliente')),  // Convertir el nombre del cliente a mayúsculas
        'fecha_venta' => $request->input('fecha_venta'),  // Fecha de la venta
        'articulos' => $articulos,  // Listado de artículos
        'total' => $totalVenta  // Total de la venta
    ];

    // Enviar la venta a Firebase (usando la tabla de ventas)
    $ventaRef = $this->database->getReference($this->tablaVentas)->push($ventaData);

    // Verificar si la venta fue guardada correctamente
    if ($ventaRef) {
        // Actualizar el stock de los productos en Firebase
        foreach ($articulos as $articulo) {
            $productoRef = $this->database->getReference($this->tablaProductos . '/' . $articulo['codigo']);
            $producto = $productoRef->getValue();

            // Si el producto existe, actualizar el stock
            if ($producto) {
                $nuevoStock = $producto['stock'] - $articulo['cantidad'];
                if ($nuevoStock < 0) $nuevoStock = 0;  // Evitar que el stock sea negativo

                // Actualizar el stock en Firebase
                $productoRef->update(['stock' => $nuevoStock]);
            }
        }

        // Redirigir con éxito
        return redirect()->route('RealizarVenta.index')->with('status', 'Venta realizada exitosamente.');
    } else {
        // Redirigir con mensaje de error si no se guardó correctamente
        return redirect()->route('RealizarVenta.index')->with('status', 'No se pudo realizar la venta.');
    }
}

// Método para buscar artículos
public function searchArticulo(Request $request)
{
    $query = $request->query('query', ''); // Obtén la consulta de búsqueda o una cadena vacía
    $productos = $this->database->getReference($this->tablaProductos)->getValue();

    // Si hay una consulta de búsqueda, filtra los productos
    if ($query) {
        $productos = array_filter($productos, function ($producto) use ($query) {
            return stripos($producto['nombre_producto'], $query) !== false;
        });
    }

    return response()->json($productos);
}
}
