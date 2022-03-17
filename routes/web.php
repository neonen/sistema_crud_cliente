<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function(){

    Route::prefix('cliente')->group(function(){
        $controller = ClienteController::class;
        Route::get('view',[$controller,'view'])->name('cliente');
        Route::post('create',[$controller,'create']);
        Route::get('read',[$controller,'read']);
        Route::put('update',[$controller,'update']);
        Route::delete('delete',[$controller,'delete']);
    });

});

require __DIR__.'/auth.php';
