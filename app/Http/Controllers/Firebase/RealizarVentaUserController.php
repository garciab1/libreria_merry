<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class RealizarVentaUserController extends Controller
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

    public function indexRuser()
    {
        return view('realizarVentaUser');
    }

    public function storeRuser(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'fecha_venta' => 'required|date_format:Y-m-d\TH:i',
            'articulos' => 'required|json'
        ]);
    
        // Decodificar los artículos del JSON
        $articulos = json_decode($request->input('articulos'), true);
    
        if (empty($articulos)) {
            return redirect()->route('RealizarVentaUser.index')->with('status', 'No se han agregado artículos a la venta.');
        }
    
        // Verificar que todos los artículos tengan stock disponible
        foreach ($articulos as $articulo) {
            $productoRef = $this->database->getReference($this->tablaProductos . '/' . $articulo['codigo']);
            $producto = $productoRef->getValue();
    
            if ($producto && $producto['stock'] <= 0) {
                // Si algún artículo tiene stock 0, redirige con un mensaje de error
                return redirect()->route('RealizarVentaUser.index')->with('status', 'El artículo ' . $producto['nombre_producto'] . ' no está disponible.');
            }
        }
    
        // Preparar los datos de la venta
        $ventaData = [
            'nombre_cliente' => strtoupper($request->input('nombre_cliente')),
            'fecha_venta' => $request->input('fecha_venta'),
            'articulos' => $articulos,
            'total' => array_sum(array_column($articulos, 'subtotal'))
        ];
    
        // Registrar la venta en Firebase
        $ventaRef = $this->database->getReference($this->tablaVentas)->push($ventaData);
    
        if ($ventaRef) {
            // Actualizar el stock de los productos
            foreach ($articulos as $articulo) {
                $productoRef = $this->database->getReference($this->tablaProductos . '/' . $articulo['codigo']);
                $producto = $productoRef->getValue();
    
                if ($producto) {
                    $nuevoStock = $producto['stock'] - $articulo['cantidad'];
    
                    // Asegura que el stock no quede en negativo
                    if ($nuevoStock < 0) $nuevoStock = 0;
    
                    // Actualizar el stock en Firebase
                    $productoRef->update(['stock' => $nuevoStock]);
                }
            }
    
            // Redirigir a la vista del comprobante
            return redirect()->route('RealizarVenta.imprimirComprobante', $ventaRef->getKey())->with('status', 'Venta realizada exitosamente.');
        } else {
            return redirect()->route('RealizarVentaUser.index')->with('status', 'No se pudo realizar la venta.');
        }
    }
    



    // Método para buscar artículos
    public function searchArticuloRuser(Request $request)
    {
        $query = $request->query('query', ''); // Obtiene la consulta de búsqueda o una cadena vacía
        $productos = $this->database->getReference($this->tablaProductos)->getValue();

        // Si hay una consulta de búsqueda, filtra los productos
        if ($query) {
            $productos = array_filter($productos, function ($producto) use ($query) {
                return stripos($producto['nombre_producto'], $query) !== false;
            });
        }

        return response()->json($productos);
    }

    public function imprimirComprobante($ventaId)
    {
        // Obtener la venta específica desde Firebase
        $venta = $this->database->getReference($this->tablaVentas . '/' . $ventaId)->getValue();
    
        if (!$venta) {
            return redirect()->route('RealizarVentaUser.index')->with('status', 'Venta no encontrada.');
        }
    
        // Asegúrar de que cada artículo tenga el nombre del producto
        foreach ($venta['articulos'] as &$articulo) {
            $codigoProducto = $articulo['codigo'];
            $producto = $this->database->getReference($this->tablaProductos . '/' . $codigoProducto)->getValue();
            $articulo['nombre_producto'] = $producto['nombre_producto'] ?? 'Producto desconocido';
        }
    
        return view('comprobanteVenta', compact('venta'));
    }
    


}




