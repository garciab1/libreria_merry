<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\Inicioadmin_Controller;
use App\Http\Controllers\InicioUser_Controller;
use App\Http\Controllers\RealizarVenta_Controller;
use App\Http\Controllers\HistorialVentas_Controller;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\Firebase\NewproductoController;
use App\Http\Controllers\Firebase\EmpleadosController;
use App\Http\Controllers\Firebase\RealizarVentaController;
use App\Http\Controllers\Firebase\RealizarVentaUserController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\auth\GoogleController;
Route::get('realizar-venta/imprimir/{ventaId}', [RealizarVentaController::class, 'imprimirComprobante'])->name('RealizarVenta.imprimirComprobante');





//Rutas creadas para uso de la base de datos para realizar venta admin
Route::get('/realizarVentaAdmin', [RealizarVentaController::class, 'index'])->name('RealizarVenta.index');
Route::post('/realizarVentaAdmin', [RealizarVentaController::class, 'store'])->name('RealizarVenta.store');
Route::get('/realizarVentaAdmin-buscar', [RealizarVentaController::class, 'searchArticulo'])->name('RealizarVenta.buscarArticulo');
Route::get('/historial-ventas', [RealizarVentaController::class, 'showVentas'])->name('HistorialVentas');

//Rutas creadas para uso de la base de datos para realizar venta USER
Route::get('/realizarVentaUser', [RealizarVentaUserController::class, 'indexRuser'])->name('RealizarVentaUser.index');
Route::post('/realizarVentaUser', [RealizarVentaUserController::class, 'storeRuser'])->name('RealizarVentaUser.store');
Route::get('/realizarVentaUser-buscar', [RealizarVentaUserController::class, 'searchArticuloRuser'])->name('RealizarVentaUser.buscarArticulo');


//Rutas creadas para uso de la base de datos 
Route::get('/productos', [ContactController::class, 'index']); //visualizar producto stock
Route::get('/add-product', [ContactController::class, 'create']); //agregar producto
Route::post('/add-product', [ContactController::class, 'store']);
Route::get('edit-producto/{id}', [ContactController::class, 'editProducto']); //mostrar editar
Route::put('update-producto/{id}', [ContactController::class, 'updateProducto']); //actualizar
Route::get('delete-producto/{id}', [ContactController::class, 'destroyProducto']); //eliminar

//User para productos
Route::get('/productosUser', [NewproductoController::class, 'indexUser']); //visualizar producto stock
Route::get('/add-productUser', [NewproductoController::class, 'createUser']); //agregar producto
Route::post('/add-productUser', [NewproductoController::class, 'storeUser']);
Route::get('edit-productoUser/{id}', [NewproductoController::class, 'editProductoUser']); //mostrar editar
Route::put('update-productoUser/{id}', [NewproductoController::class, 'updateProductoUser']); //actualizar
Route::get('delete-productoUser/{id}', [NewproductoController::class, 'destroyProductoUser']); //eliminar

//Rutas para Empleados
Route::get('/empleados2', [EmpleadosController::class, 'indexEmpleados']); //Ver listado admin
Route::get('/add-empleado', [EmpleadosController::class, 'createEmpleado']); //vista agregar empleado
Route::post('/add-empleado', [EmpleadosController::class, 'storeEmpleado']); //guardar
Route::get('edit-empleado/{id}', [EmpleadosController::class, 'editEmpleado']); //mostrar editar
Route::put('update-empleado/{id}', [EmpleadosController::class, 'updateEmpleado']); //actualizar
Route::get('delete-empleado/{id}', [EmpleadosController::class, 'destroyEmpleado']); //eliminar

//RutasBasicas
Route::get('/', [HomeControler::class,'index']);

Route::middleware([CheckRole::class.':admin'])->group(function () {
    Route::get('/inicio_admin', [Inicioadmin_Controller::class, 'inicio_admin'])->name('IniAdmin');
});

Route::middleware([CheckRole::class.':user'])->group(function () {
    Route::get('/inicio_user', [InicioUser_Controller::class, 'inicio_user'])->name('IniUser');
});

//Autenticacion

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/callback/google', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/testfire', [GoogleController::class, 'testFirebaseConnection']);

//Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');
//Route::get('/inicio_user',[InicioUser_Controller::class,'inicio_user'])->name('IniUser');
Route::get('/realizarVenta',[RealizarVenta_Controller::class,'realizarVenta'])->name('RealizarVenta');


