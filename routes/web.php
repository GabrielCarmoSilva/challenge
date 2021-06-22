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

Route::get('/usuarios', 'UserController@index'); //Visualizar todos os usuários
Route::post('/usuarios', 'UserController@store'); //Criar usuário
Route::patch('/usuarios/{user}', 'UserController@update'); //Editar usuário
Route::get('/usuarios/{user}', 'UserController@show'); //Visualizar informações de um usuário
Route::delete('/usuarios/{user}', 'UserController@destroy'); //Deletar usuário

Route::get('/contas', 'AccountController@index'); //Visualizar todas as contas pessoais
Route::post('/contas/pessoal', 'AccountController@storePersonalAccount'); //Criar conta pessoal
Route::patch('/contas/pessoal/{account}', 'AccountController@updatePersonalAccount'); //Editar conta pessoal
Route::patch('/contas/empresarial/{account}', 'AccountController@updateCompanyAccount'); //Editar conta empresarial 
Route::post('/contas/empresarial', 'AccountController@storeCompanyAccount'); //Criar conta empresarial
Route::get('/contas/{account}', 'AccountController@show'); //Visualizar informações de uma conta pessoal
Route::delete('/contas/{account}', 'AccountController@destroy'); //Deletar conta pessoal

Route::get('/transacoes', 'TransactionController@index');
Route::post('/transacoes', 'TransactionController@store');
Route::get('/transacoes/{transaction}', 'TransactionController@get');
