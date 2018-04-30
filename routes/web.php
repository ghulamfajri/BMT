<?php

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
    return view('home_page');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home_page');
Route::get('/logout', 'HomeController@logout');

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth','permissions.required:admin']], function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::get('/dashboard', [
        'as'        => 'dashboard',
        'uses'      => 'AdminController@index'
    ]);

    Route::group(['prefix' => 'simpanan', 'middleware' => ['auth']], function () {
        Route::get('/pengajuan', [
            'as'        => 'pengajuan_simpanan',
            'uses'      => 'AdminController@pengajuan_simpanan'
        ]);
    });

    Route::group(['prefix' => 'datamaster', 'middleware' => ['auth']], function () {

        Route::get('/anggota', [
            'as'        => 'data_anggota',
            'uses'      => 'AdminController@data_anggota'
        ]);
        Route::group(['prefix' => 'anggota', 'middleware' => ['auth']], function () {
            Route::post('/add_anggota', [
                'as'        => 'admin.datamaster.anggota.add_anggota',
                'uses'      => 'DatamasterController@add_anggota'
            ]);
            Route::post('/edit_anggota', [
                'as'        => 'admin.datamaster.anggota.edit_anggota',
                'uses'      => 'DatamasterController@edit_anggota'
            ]);
            Route::post('/delete_anggota', [
                'as'        => 'admin.datamaster.anggota.delete_anggota',
                'uses'      => 'DatamasterController@delete_anggota'
            ]);
            Route::post('/edit', [
                'as'        => 'admin.datamaster.anggota.pwd_anggota',
                'uses'      => 'DatamasterController@editPwd_anggota'
            ]);
        });

        Route::get('/rekening', [
            'as'        => 'data_rekening',
            'uses'      => 'AdminController@data_rekening'
        ]);
        Route::group(['prefix' => 'rekening', 'middleware' => ['auth']], function () {
            Route::post('/add_rekening', [
                'as'        => 'admin.datamaster.rekening.add_rekening',
                'uses'      => 'DatamasterController@add_rekening'
            ]);
            Route::post('/edit_rekening', [
                'as'        => 'admin.datamaster.rekening.edit_rekening',
                'uses'      => 'DatamasterController@edit_rekening'
            ]);
            Route::post('/delete_rekening', [
                'as'        => 'admin.datamaster.rekening.delete_rekening',
                'uses'      => 'DatamasterController@delete_rekening'
            ]);
        });

        Route::get('/simpanan', [
            'as'        => 'data_simpanan',
            'uses'      => 'AdminController@data_simpanan'
        ]);
        Route::group(['prefix' => 'simpanan', 'middleware' => ['auth']], function () {
            Route::post('/add_simpanan', [
                'as'        => 'admin.datamaster.simpanan.add_simpanan',
                'uses'      => 'DatamasterController@add_simpanan'
            ]);
            Route::post('/edit_simpanan', [
                'as'        => 'admin.datamaster.simpanan.edit_simpanan',
                'uses'      => 'DatamasterController@edit_simpanan'
            ]);
            Route::post('/delete_simpanan', [
                'as'        => 'admin.datamaster.simpanan.delete_simpanan',
                'uses'      => 'DatamasterController@delete_simpanan'
            ]);
        });
    });
});

//anggota
Route::group(['prefix' => 'anggota', 'middleware' => ['auth','permissions.required:anggota']], function () {

    Route::get('/', function () {
        return view('users.dashboard');
    });

    Route::get('/dashboard', [
        'as'        => 'dashboard',
        'uses'      => 'AdminController@index'
    ]);

    Route::group(['prefix' => 'simpanan', 'middleware' => ['auth']], function () {
        Route::get('/pengajuan', [
            'as'        => 'pengajuan_simpanan',
            'uses'      => 'AdminController@pengajuan_simpanan'
        ]);
    });

});