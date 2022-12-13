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

Route::get('bands', 'App\Http\Controllers\BandController@getAll');

Route::get('bands/{id}', 'App\Http\Controllers\BandController@getById');

Route::post('create', 'App\Http\Controllers\IncomeController@create');

Route::get('incomes', 'App\Http\Controllers\IncomeController@index');

Route::get('incomes/{id}', 'App\Http\Controllers\IncomeController@getIncome');

Route::put('incomes/{id}', 'App\Http\Controllers\IncomeController@update');

Route::delete('incomes/{id}', 'App\Http\Controllers\IncomeController@delete');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
