<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('incomes/create', 'App\Http\Controllers\IncomeController@create');

Route::get('incomes/', 'App\Http\Controllers\IncomeController@index');

Route::get('incomes/{id}', 'App\Http\Controllers\IncomeController@getIncome');

Route::get('incomes/{y}/{m}', 'App\Http\Controllers\IncomeController@IncomeByMonth');

Route::put('incomes/{id}', 'App\Http\Controllers\IncomeController@update');

Route::delete('incomes/{id}', 'App\Http\Controllers\IncomeController@delete');

Route::post('expenses/create', 'App\Http\Controllers\ExpenseController@create');

Route::get('expenses', 'App\Http\Controllers\ExpenseController@index');

Route::get('expenses/{id}', 'App\Http\Controllers\ExpenseController@getIncome');

Route::put('expenses/{id}', 'App\Http\Controllers\ExpenseController@update');

Route::delete('expenses/{id}', 'App\Http\Controllers\ExpenseController@delete');

Route::get('expenses/{y}/{m}', 'App\Http\Controllers\ExpenseController@ExpenseByMonth');

Route::get('resumo/{y}/{m}', 'App\Http\Controllers\ResumoController@index');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
