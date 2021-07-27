<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'digging_deeper'],function (){
    Route::get('collections','DiggingDeeperController@collections')
        ->name('digging_deeper.collections');
});


Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});

//Route::resource('rest', 'RestController')->names('rest');

// админка блога
$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];
Route::group($groupData, function () {
    //Blog categories
    $methods = ['index', 'edit', 'create', 'store', 'update',];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    //Blog posts
    Route::resource('posts','PostController')
        ->except(['show']) // все кроме метода show
        ->names('blog.admin.posts'); // наименование
});
