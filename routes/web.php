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

Route::get('/', 'HomeController@migoos')->name('migoos');
Route::post('/cargareventos', 'HomeController@cargareventos')->name('cargareventos');
Route::get('/cargarcombos', 'HomeController@cargarcombos')->name('cargarcombos');
Route::get('/cargarciudades', 'HomeController@cargarciudades')->name('cargarciudades');
Route::get('b/{any}', 'HomeController@migoos')->name('b/{any}')->where('any', '.*');

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::get('/verificaremail/{token}', 'Auth\RegisterController@verificaremail');
Route::get('/pruebacola', 'HomeController@pruebacola');
Route::get('email',function (){
   return view('emails.emailverificacion')->with(['nombre'=>'Breyner Perez','email_token'=>'breyner@hotmail.com']);
});
//Route::get('/app/{ciudad}', 'HomeController@app')->name('app');

Auth::routes();

Route::get('mail', 'HomeController@mail');
Route::group(['middleware' => ['authuser']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/app/{any}', 'AdminController@index')
        ->middleware('is_admin')
        ->name('app.admin')->where('any', '.*');
    #cargar combos

    Route::post('/guardarevento', 'AdminController@guardarevento')->name('guardarevento');
    Route::post('/guardarimagen/{id}', 'AdminController@guardarimagen')->name('guardarimagen');
    Route::delete('/eliminarevento/{id}', 'AdminController@eliminarevento')->name('eliminarevento');
    Route::post('/favorito/{id}/{favorito}', 'AdminController@favorito')->name('favorito');
    Route::get('/edit/{id}', 'AdminController@obtenerdatosevento')->name('edit');
});
