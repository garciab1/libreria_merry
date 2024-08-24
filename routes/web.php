<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\Inicioadmin_Controller;

Route::get('/', [HomeControler::class,'index']);
Route::get('/inicio_admin',[Inicioadmin_Controller::class,'inicio_admin'])->name('IniAdmin');



