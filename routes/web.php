<?php

use App\Http\Controllers\AgregarVentaAdmin_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\Inicioadmin_Controller;
use App\Http\Controllers\InicioUser_Controller;
use App\Http\Controllers\RealizarVenta_Controller;
use App\Http\Controllers\RealizarVentaAdmin_Controller;
use App\Http\Controllers\AgregarProducto_Controller;
use App\Http\Controllers\AgregarProductoAdmin_Controller;
use App\Http\Controllers\CrearUsuario_Controller;
use App\Http\Controllers\Empleados_Controller;
use App\Http\Controllers\HistorialVentas_Controller;
use App\Http\Controllers\ProductosStock_Controller;
use App\Http\Controllers\Firebase\ContactController;

//Rutas creadas para uso de la base de datos
Route::get('productos', [ContactController::class, 'index']);
Route::get('add-product', [ContactController::class, 'create']);
Route::post('add-product', [ContactController::class, 'store']);




Route::get('/', [HomeControler::class,'index']);
Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');
Route::get('/inicio_user',[InicioUser_Controller::class,'inicio_user'])->name('IniUser');
Route::get('/realizarVenta',[RealizarVenta_Controller::class,'realizarVenta'])->name('RealizarVenta');
Route::get('/realizarVentaAdmin',[RealizarVentaAdmin_Controller::class,'realizarVentaAdmin'])->name('RealizarVenta');
Route::get('/AgregarProducto',[AgregarProducto_Controller::class,'AgregarProducto'])->name('AgregarProducto');
Route::get('/AgregarProductoAdmin',[AgregarProductoAdmin_Controller::class,'AgregarProductoAdmin'])->name('AgregarProductoAdmin');

Route::get('/ProductosStock',[ProductosStock_Controller::class,'ProductosStock'])->name('ProductosStock');

Route::get('/HistorialVentas',[HistorialVentas_Controller::class,'HistorialVentas'])->name('HistorialVentas');

Route::get('/Empleados',[Empleados_Controller::class,'Empleados'])->name('Empleados');

Route::get('/CrearUsuario',[CrearUsuario_Controller::class,'CrearUsuario'])->name('CrearUsuario');