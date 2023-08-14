<?php

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

//INDEX - LOGGIN
Route::get('/ContaAlerta', function () {
    return view('index');
});

//MENU PRINCIPAL
Route::get('/ContaAlerta/menu-principal', function () {
    return view('menu-principal');
});

//CONTAS SALVAS
Route::ANY('/ContaAlerta/contas-disponiveis',[App\Http\Controllers\SalvarContaController::class,'lerContas']);

Route::ANY('/ContaAlerta/Contasave/novaConta/{conteudo}',[App\Http\Controllers\SalvarContaController::class,'mostrarDetalhes']);

//SALVAR CONTA
Route::ANY('/ContaAlerta/ContaSave', function () {
    return view('cadastro');
});

//RECAREGAR CONTA
Route::post('/ContaAlerta/Contasave/recarga',[App\Http\Controllers\SalvarContaController::class,'recarregarConta']);

Route::post('/ContaAlerta/Contasave/novaConta',[App\Http\Controllers\SalvarContaController::class,'salvarConta']);
//Route::post('/indexAction',[App\Http\Controllers\LogginController::class,'loginUser']);
//Route::get('/menu-principal',[App\Http\Controllers\LogginController::class,'menuUser']);
//Route::post('/ContaAlerta/Contasave/recarga',[App\Http\Controllers\RecarregarController::class,'recarga']);
//Route::post('/ContaAlerta/Contasave',[App\Http\Controllers\SalvarContaController::class,'recarga']);
