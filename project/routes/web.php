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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => 'auth:web'
    ],
    function () {
        Route::get('/', 'DashboardController');

        Route::group(['prefix' => '/servers'], function (){
            Route::post('/import', 'ServerController@import')->name('servers.import');
            Route::get('/', 'ServerController@index')->name('servers.index');
            Route::get('/create', 'ServerController@create')->name('servers.create');
            Route::delete('/{id}', 'ServerController@destroy')->name('servers.destroy');
            Route::get('/{id}/edit', 'ServerController@edit')->name('servers.edit');
            Route::post('/', 'ServerController@store')->name('servers.store');
            Route::match(['PUT', 'PATCH'], '/{id}', 'ServerController@update')->name('servers.update');

        });

});
