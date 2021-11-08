<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // klasifikasi
    Route::get('klasifikasi', 'KlasifikasiController@index');
    Route::get('klasifikasi/create', 'KlasifikasiController@create');
    Route::post('klasifikasi/store', 'KlasifikasiController@store');
    Route::get('klasifikasi/edit/{id}', 'KlasifikasiController@edit');
    Route::post('klasifikasi/update/{id}', 'KlasifikasiController@update');
    Route::get('klasifikasi/delete/{id}', 'KlasifikasiController@destroy');

    // surat masuk
    Route::get('suratmasuk','SuratMasukController@index');
    Route::get('suratmasuk/create','SuratMasukController@create');
    Route::post('suratmasuk/store', 'SuratMasukController@store');
    Route::get('suratmasuk/edit/{id}', 'SuratMasukController@edit');
    Route::post('suratmasuk/update/{id}', 'SuratMasukController@update');
    Route::get('suratmasuk/delete/{suratmasuk:id}', 'SuratMasukController@destroy');
    Route::get('suratmasuk/agenda', 'SuratMasukController@agenda')->name('suratmasuk.agenda');
    Route::get('suratmasuk/agendamasuk_pdf', 'SuratMasukController@agendamasuk_pdf')->name('auth.cetak_pdf');

    //  Surat Keluar
    Route::get('suratkeluar', 'SuratKeluarController@index');
    Route::get('suratkeluar/create', 'SuratKeluarController@create');
    Route::post('suratkeluar/store', 'SuratKeluarController@store');
    Route::get('suratkeluar/edit/{id}', 'SuratKeluarController@edit');
    Route::post('suratkeluar/update/{id}', 'SuratKeluarController@update');
    Route::get('suratkeluar/delete/{id}', 'SuratKeluarController@destroy');
    Route::get('suratkeluar/agenda', 'SuratKeluarController@agenda')->name('suratkeluar.agenda');
    Route::get('suratkeluar/agendakeluar_pdf', 'SuratKeluarController@agendakeluar_pdf')->name('auth.cetak_pdf');

    // setting user
    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::post('user/store', 'UserController@store');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::post('user/update/{id}', 'UserController@update');
    Route::get('user/delete/{id}', 'UserController@destroy');
    Route::get('user/profil', 'UserController@profil');
    Route::post('user/update-profil/{id}', 'UserController@ubah_profil');
    Route::get('user/password', 'UserController@password');
    Route::post('user/ubah-password', 'UserController@ubah_password');

    // instansi
    Route::get('instansi', 'InstansiController@index');
    Route::get('instansi/show', 'InstansiController@show');
    Route::post('instansi/update/{id}', 'InstansiController@update');

});
