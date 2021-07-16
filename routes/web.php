<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/index','RestController@index');
Route::resource('rest','RestController')->names('rest');
