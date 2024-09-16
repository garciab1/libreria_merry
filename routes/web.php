<?php

use App\Http\Controllers\AgregarVentaAdmin_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\Inicioadmin_Controller;
use App\Http\Controllers\InicioUser_Controller;
use App\Http\Controllers\RealizarVenta_Controller;
use App\Http\Controllers\RealizarVentaAdmin_Controller;
use App\Http\Controllers\HistorialVentas_Controller;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\Firebase\EmpleadosController;
use App\Http\Controllers\Firebase\RealizarVentaController;

Route::get('/realizarVentaAdmin', [RealizarVentaController::class, 'index'])->name('RealizarVenta.index');
Route::post('/realizarVentaAdmin', [RealizarVentaController::class, 'store'])->name('RealizarVenta.store');
Route::get('/realizarVentaAdmin-buscar', [RealizarVentaController::class, 'searchArticulo'])->name('RealizarVenta.buscarArticulo');



//Rutas creadas para uso de la base de datos
Route::get('/productos', [ContactController::class, 'index']); //visualizar producto stock
Route::get('/add-product', [ContactController::class, 'create']); //agregar producto
Route::post('/add-product', [ContactController::class, 'store']);
Route::get('edit-producto/{id}', [ContactController::class, 'editProducto']); //mostrar editar
Route::put('update-producto/{id}', [ContactController::class, 'updateProducto']); //actualizar
Route::get('delete-producto/{id}', [ContactController::class, 'destroyProducto']); //eliminar

//Rutas para Empleados
Route::get('/empleados2', [EmpleadosController::class, 'indexEmpleados']); //Ver listado admin
Route::get('/add-empleado', [EmpleadosController::class, 'createEmpleado']); //vista agregar empleado
Route::post('/add-empleado', [EmpleadosController::class, 'storeEmpleado']); //guardar
Route::get('edit-empleado/{id}', [EmpleadosController::class, 'editEmpleado']); //mostrar editar
Route::put('update-empleado/{id}', [EmpleadosController::class, 'updateEmpleado']); //actualizar
Route::get('delete-empleado/{id}', [EmpleadosController::class, 'destroyEmpleado']); //eliminar





Route::get('/', [HomeControler::class,'index']);
Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');
Route::get('/inicio_user',[InicioUser_Controller::class,'inicio_user'])->name('IniUser');
Route::get('/realizarVenta',[RealizarVenta_Controller::class,'realizarVenta'])->name('RealizarVenta');
//Route::get('/realizarVentaAdmin',[RealizarVentaAdmin_Controller::class,'realizarVentaAdmin'])->name('RealizarVenta');
Route::get('/HistorialVentas',[HistorialVentas_Controller::class,'HistorialVentas'])->name('HistorialVentas');

