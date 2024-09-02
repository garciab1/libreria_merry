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

Route::get('/', [HomeControler::class,'index']);
Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');
Route::get('/inicio_user',[InicioUser_Controller::class,'inicio_user'])->name('IniUser');
Route::get('/realizarVenta',[RealizarVenta_Controller::class,'realizarVenta'])->name('RealizarVenta');
Route::get('/realizarVentaAdmin',[RealizarVentaAdmin_Controller::class,'realizarVentaAdmin'])->name('RealizarVenta');
Route::get('/AgregarProducto',[AgregarProducto_Controller::class,'AgregarProducto'])->name('AgregarProducto');
Route::get('/AgregarProductoAdmin',[AgregarProductoAdmin_Controller::class,'AgregarProductoAdmin'])->name('AgregarProductoAdmin');

