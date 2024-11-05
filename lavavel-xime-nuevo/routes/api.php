<?php

use App\Http\Controllers\ControladorCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clientes',[ControladorCliente::class, 'lista']); 
Route::get('/clientes/{id}',[ControladorCliente::class, 'cliente']); 
Route::post('/clientes' ,[ControladorCliente::class,'crear']); 
Route::put('/clientes/{id}',[ControladorCliente::class, 'actualizar']); 
Route::delete('/clientes/{id}',[ControladorCliente::class,  'eliminar']); 
Route::patch('/clientes/{id}',[ControladorCliente::class,  'actualizardato']); 