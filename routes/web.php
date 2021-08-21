<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/backend/home', function () {
    return view('backend.template');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/backend/user', 'UserController');
    Route::get('/user/profil', 'ProfilUpdateController@profil');
    Route::post('/user/update-profil/{id}', 'ProfilUpdateController@ubah_profil');
    Route::get('/user/password', 'ProfilUpdateController@password');
    Route::post('/user/ubah-password', 'ProfilUpdateController@ubah_password');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
