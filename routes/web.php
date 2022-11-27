<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\Middleware;
use Illuminate\Http\Request;

Route::middleware([Middleware::class])->group(function () {
    Route::get('/registro', [ClienteController::class, 'registrarCliente']);
    Route::post('/registro', [ClienteController::class, 'guardar']);
    Route::get('/clientes', [ClienteController::class, 'showClients']);
    Route::get('/actualizarCliente/idCliente={id}', [ClienteController::class, 'getClient']);
    Route::post('/actualizarCliente/idCliente={id}', [ClienteController::class, 'updateCliente']);

    Route::get('/registroProcedimientos', [ProcedimientoController::class, 'registrarProcedimiento']);
    Route::post('/registroProcedimientos', [ProcedimientoController::class, 'registroProcedimiento']);

    Route::get('/logout', function (Request $req) {
        $req->session()->flush();
        return redirect('/login');
    });
    Route::get('/dashboard', [DashboardController::class, 'getDashboard']);
    Route::get('/dashboard/ot={id}', [DashboardController::class, 'showProc']);
    Route::post('/dashboard/ot={id}', [ProcedimientoController::class, 'updateProcedimiento']);
    Route::get('/listaUsuarios', [UsuarioController::class,'showUsers']);
    Route::get('/getDatosCliente',[ClienteController::class, 'getDatosCliente'])->name('getDatosCliente');


});

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [authController::class, 'login']);
Route::post('/login', [authController::class, 'loginUser']);
Route::get('/seguimiento', function () {
    return view('/publico/seguimiento');

});


