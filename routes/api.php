<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' =>  'categoria'], function (){
        Route::get('', 'CategoriasController@pegarDados');
        Route::get('{id}','CategoriasController@pegarCategoria');
        Route::post('','CategoriasController@salvarCategoria');
        Route::put('{id}','CategoriasController@editarCategoria');
        Route::delete('','CategoriasController@deletarCategoria');
    }
);
