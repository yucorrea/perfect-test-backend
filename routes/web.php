<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;


/*
Telas para ver o funcionamento sem dados
*/
Route::match(['GET', 'POST'], '/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProdutoController::class);

Route::resource('clients', ClienteController::class);

Route::resource('sales', VendaController::class);