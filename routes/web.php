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
    Route::resource('klasifikasi', 'KlasifikasiController');
    Route::get('klasifikasi/delete/{klasifikasi:id}', 'KlasifikasiController@destroy');
    Route::post('klasifikasi/import', 'KlasifikasiController@import');

    // surat masuk
    Route::resource('suratmasuk','SuratMasukController', ['only'=> ['index','create','store','edit','update','delete']]);
    Route::get('suratmasuk/agenda', 'SuratMasukController@agenda')->name('suratmasuk.agenda');
    Route::get('suratmasuk/agendamasuk_pdf', 'SuratMasukController@agendamasuk_pdf')->name('auth.cetak_pdf');
    Route::get('suratmasuk/delete/{suratmasuk:id}', 'SuratMasukController@destroy');

    //  Surat Keluar
    Route::resource('suratkeluar', 'SuratKeluarController');
    Route::get('suratkeluar/delete/{suratkeluar:id}', 'SuratKeluarController@destroy');

    // setting user
    Route::resource('user', 'UserController');
    Route::get('user/profil', 'ProfilUpdateController@index');
    Route::post('user/update-profil/{id}', 'ProfilUpdateController@ubah_profil');
    Route::get('user/password', 'ProfilUpdateController@password');
    Route::post('user/ubah-password', 'ProfilUpdateController@ubah_password');

    // instansi
    Route::resource('instansi', 'InstansiController');

});
