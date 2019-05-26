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
Route::get('/test',function(){
    return App\User::find(1)->profile; 
});


Route::get('/','FrontEndController@index')->name('index');
Route::get('/post/{slug}','FrontEndController@singlePost')->name('post.single');
Route::get('/category/{id}','FrontEndController@category')->name('category.single');
Route::get('/tag/{id}','FrontEndController@tag')->name('tag.single');
Route::get('/results','FrontEndController@search')->name('results');


Route::post('/email_subscripe','FrontEndController@email_subscripe')->name('email_s');

Auth::routes();



Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/post/create', 'PostsController@create')->name('post.create');
    Route::post('/post/store', 'PostsController@store')->name('post.store');
    Route::get('/post/delete/{id}', 'PostsController@destroy')->name('post.delete');
    Route::get('/posts', 'PostsController@index')->name('posts'); 
    Route::get('/post/trashed', 'PostsController@trashed')->name('post.trashed');
    Route::get('/post/kill/{id}', 'PostsController@kill')->name('post.kill');
    Route::get('/post/restore/{id}', 'PostsController@restore')->name('post.restore');  
    Route::get('/post/edit/{id}', 'PostsController@edit')->name('post.edit');
    Route::post('/post/update/{id}', 'PostsController@update')->name('post.update');
    
    
    Route::get('/category/create', 'CategoriesController@create')->name('category.create');
    Route::post('/category/store', 'CategoriesController@store')->name('category.store');
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
    Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('category.update');
    
    
    Route::get('/tag/create', 'TagController@create')->name('tag.create');
    Route::post('/tag/store', 'TagController@store')->name('tag.store');
    Route::get('/tags', 'TagController@index')->name('tags');
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    Route::get('/tag/delete/{id}', 'TagController@destroy')->name('tag.delete');
    Route::post('/tag/update/{id}', 'TagController@update')->name('tag.update');
    
    
    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/user/create', 'UsersController@create')->name('user.create');
    Route::post('/user/store', 'UsersController@store')->name('user.store');
    Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.edit');
    Route::get('/user/delete/{id}', 'UsersController@destroy')->name('user.delete');
    Route::post('/user/update/{id}', 'UsersController@update')->name('user.update');

    Route::get('/user/admin/{id}', 'UsersController@admin')->name('user.admin');
    Route::get('/user/not_admin/{id}', 'UsersController@not_admin')->name('user.not_admin');

    
    Route::get('/user/profile', 'ProfilesController@index')->name('user.profile');
    Route::post('/user/profile/update', 'ProfilesController@update')->name('user.profile.update');

    
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings/update', 'SettingsController@update')->name('settings.update');
});
