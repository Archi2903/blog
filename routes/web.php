<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/index','RestController@index');
Route::resource('rest','RestController')->names('rest');

Route::group(['namespace'=>'Blog','prefix'=>'blog'],function (){
   Route::resource('posts','PostController')->names('blog.posts');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// админка блога
$groupData=[
    'namespace'=>'Blog\Admin',
    'prefix'=>'admin/blog',
];

Route::group($groupData,function (){
    //Blog categories
    $methods=['index','edit','create','store','update',];
    Route::resource('categories','CategoryController')->only($methods)->names('blog.admin.categories');
});
