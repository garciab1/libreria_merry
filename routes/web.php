<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\Inicioadmin_Controller;
use App\Http\Controllers\InicioUser_Controller;
use App\Http\Controllers\RealizarVenta_Controller;
use App\Http\Controllers\RealizarVentaAdmin_Controller;

Route::get('/', [HomeControler::class,'index']);
Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');
Route::get('/inicio_user',[InicioUser_Controller::class,'inicio_user'])->name('IniUser');
Route::get('/realizarVenta',[RealizarVenta_Controller::class,'realizarVenta'])->name('RealizarVenta');
Route::get('/realizarVentaAdmin',[RealizarVentaAdmin_Controller::class,'realizarVentaAdmin'])->name('RealizarVenta');

