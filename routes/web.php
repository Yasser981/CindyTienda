<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDatatableController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagosDatatableController;
use App\Http\Controllers\ImprecionPagoController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::redirect('/', 'login');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('users',UserController::class);

    Route::resource('pagos',PagoController::class);

    Route::get('data-user',UserDatatableController::class)->name('user.table');

    Route::get('data-pagos',PagosDatatableController::class)->name('pago.table');
    
    Route::post('impresion',ImprecionPagoController::class)->name('imprecion.pagos');
});