<?php

use App\Http\Controllers\QuartoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redireciona a rota '/' para '/quartos' e '/dashboard' para '/quartos'
Route::redirect('/', '/quartos');
Route::redirect('/dashboard', '/quartos');

// Define um grupo de rotas com middleware 'auth'
Route::middleware('auth')->group(function () {
    // Grupo de rotas para operações relacionadas a quartos
    Route::prefix('quartos')->group(function () {
        Route::get('/', [QuartoController::class, 'listarQuartos'])->name('quartos-listar');
        //criação de quartos
        Route::get('/criar', [QuartoController::class, 'criarQuartos'])->name('quartos-criar');
        Route::post('/', [QuartoController::class, 'guardar'])->name('quartos-guardar');
        //edição de quartos
        Route::get('/{id}/editar', [QuartoController::class, 'editarQuartos'])->where('id', '[0-9]+')->name('quartos-editar');
        Route::put('/{id}', [QuartoController::class, 'atualizar'])->where('id', '[0-9]+')->name('quartos-atualizar');
        Route::delete('/{id}', [QuartoController::class, 'excluir'])->where('id', '[0-9]+')->name('quartos-excluir');
        //listar os disponiveis
        Route::get('/disponiveis', [QuartoController::class, 'listarDisponiveis'])->name('quartos-disponiveis');
    });

    // Grupo de rotas para operações relacionadas a clientes
    Route::prefix('clientes')->group(function () {
        Route::get('/', [QuartoController::class, 'listarClientes'])->name('clientes-listar');
        //criação de clientes
        Route::get('/criar', [QuartoController::class, 'criarClientes'])->name('clientes-criar');
        Route::post('/', [QuartoController::class, 'guardarClientes'])->name('clientes-guardar');
        //edição de clientes
        Route::get('/{id}/editar', [QuartoController::class, 'editarClientes'])->where('id', '[0-9]+')->name('clientes-editar');
        Route::put('/{id}', [QuartoController::class, 'atualizarClientes'])->where('id', '[0-9]+')->name('clientes-atualizar');
        Route::delete('/{id}', [QuartoController::class, 'excluirClientes'])->where('id', '[0-9]+')->name('clientes-excluir');



    });

    // Grupo de rotas para operações relacionadas a reservas
    Route::prefix('reservas')->group(function () {
        Route::get('/', [QuartoController::class, 'listarReservas'])->name('reservas-listar');
        //criação de reservas
        Route::get('/criar', [QuartoController::class, 'criarReservas'])->name('reservas-criar');
        Route::post('/', [QuartoController::class, 'guardarReservas'])->name('reservas-guardar');
        //edição de reservas
        Route::get('/{id}/editar', [QuartoController::class, 'editarReservas'])->where('id', '[0-9]+')->name('reservas-editar');
        Route::put('/{id}', [QuartoController::class, 'atualizarReservas'])->where('id', '[0-9]+')->name('reservas-atualizar');
        Route::delete('/{id}', [QuartoController::class, 'excluirReservas'])->where('id', '[0-9]+')->name('reservas-excluir');
        Route::get('/reservas-por-data', [QuartoController::class, 'reservasPorData'])->name('reservas-por-data');
        Route::get('/reservas-por-cliente', [QuartoController::class, 'reservasPorCliente'])->name('reservas-por-cliente');
    });
});

require __DIR__.'/auth.php';
