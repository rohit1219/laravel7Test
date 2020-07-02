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


Route::view('sample', 'sample_view');
Route::post('sample', 'Sample@register');
Route::view('login', 'login_view');
Route::post('login', 'Sample@login');

Route::get('/logout', function () {
    session()->forget('data');
    return redirect('login');
});

Route::group(['middleware'=>['CustomAuth']], function(){
    Route::get('main', 'Sample@index');
    Route::get('/delete/{id}', 'Sample@delete');
    Route::get('/edit/{user_id}', 'Sample@edit');
    Route::post('edit_update', 'Sample@edit_update');

    
    Route::get('/', function () {
        return view('welcome');
    });

});

