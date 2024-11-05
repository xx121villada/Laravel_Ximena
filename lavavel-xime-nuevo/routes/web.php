<?php

use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

// require __DIR__.'/auth.php';
Route::resource('productos', ProductosController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

