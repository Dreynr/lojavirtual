<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/products/new', [ProductsController::class, 'store']);
Route::get('/products/new', [ProductsController::class, 'create']);
Route::get('/products', [ProductsController::class, 'index']);
//edição
Route::get('/products/update/{id}', [ProductsController::class, 'edit']);
Route::post('/products/update/', [ProductsController::class, 'update']);
//excluir
Route::get('/products/delete/{id}', [ProductsController::class, 'destroy']);

