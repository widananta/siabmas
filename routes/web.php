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


Route::get('', 'WelcomeController@index');
Route::post('store', 'WelcomeController@store');
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::prefix('dashboard')->group(function(){

	Route::group(['middleware' => 'auth'], function () {
		// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
		// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
		Route::prefix('profile')->group(function () {
			Route::get('/', 'ProfileController@index');
			Route::post('/change_photo', 'ProfileController@change_photo');
			Route::post('/update', 'ProfileController@update');
			Route::post('/password', 'ProfileController@password');
		});
		Route::group(['middleware' => ['role:root_user']], function () {
			Route::prefix('dosen')->group(function () {
				Route::get('', 'DosenController@index');
				Route::post('store', 'DosenController@store');
				Route::post('update', 'DosenController@update');
				Route::get('delete/{id}', 'DosenController@destroy');
			});
			Route::prefix('matkul')->group(function () {
				Route::get('', 'MatkulController@index');
				Route::post('store', 'MatkulController@store');
				Route::post('update', 'MatkulController@update');
				Route::get('delete/{id}', 'MatkulController@destroy');
			});
			Route::prefix('mahasiswa')->group(function () {
				Route::get('', 'MahasiswaController@index');
				Route::post('store', 'MahasiswaController@store');
				Route::post('update', 'MahasiswaController@update');
				Route::get('delete/{id}', 'MahasiswaController@destroy');
			});
			Route::prefix('pengampu')->group(function () {
				Route::get('', 'PengampuController@index');
				Route::post('store', 'PengampuController@store');
				Route::post('update', 'PengampuController@update');
				Route::get('delete/{id}', 'PengampuController@destroy');
			});
		});
		Route::group(['middleware' => ['role:dosen']], function () {
			Route::prefix('pengampu_mhs')->group(function () {
				Route::get('', 'PengampumhsController@index');
				Route::get('edit/{id}', 'PengampumhsController@edit');
				Route::get('show/{id}', 'PengampumhsController@show');
				Route::post('update', 'PengampumhsController@update');
			});
		});
		Route::group(['middleware' => ['role:dosen']], function () {
			Route::prefix('absent')->group(function () {
				Route::get('{id}', 'AbsentController@index');
				Route::get('show/{id}', 'AbsentController@show');
				Route::post('store', 'AbsentController@store');
			});
		});
	});
	
    
});

