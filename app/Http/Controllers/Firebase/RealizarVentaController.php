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
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'fecha_venta' => 'required|date_format:Y-m-d H:i:s',
            'articulos' => 'required|json'
        ]);

        $articulos = json_decode($request->input('articulos'), true);
        if (empty($articulos)) {
            return redirect()->route('RealizarVenta.index')->with('status', 'No se han agregado artículos a la venta.');
        }

        $ventaData = [
            'nombre_cliente' => strtoupper($request->input('nombre_cliente')),
            'fecha_venta' => $request->input('fecha_venta'),
            'articulos' => $articulos,
            'total' => array_sum(array_column($articulos, 'subtotal'))
        ];

        $ventaRef = $this->database->getReference($this->tablaVentas)->push($ventaData);

        if ($ventaRef) {
            // Actualizar el stock de los productos
            foreach ($articulos as $articulo) {
                $productoRef = $this->database->getReference($this->tablaProductos . '/' . $articulo['codigo']);
                $producto = $productoRef->getValue();
                if ($producto) {
                    $nuevoStock = $producto['stock'] - $articulo['cantidad'];
                    if ($nuevoStock < 0) $nuevoStock = 0; // Evitar stock negativo
                    $productoRef->update(['stock' => $nuevoStock]);
                }
            }

            return redirect()->route('RealizarVenta.index')->with('status', 'Venta realizada exitosamente.');
        } else {
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
