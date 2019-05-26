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

Route::get('/','PagesController@posts');
Route::get('/posts','PagesController@posts');

Route::get('/posts/{id}','PagesController@post');

//Route::post('/posts/store','PagesController@store');

Route::post('/posts/{post}/store','CommentsController@store');

Route::get('/category/{name}','PagesController@category');

//Auth
Route::get('/register','Registration@create');
Route::post('/register','Registration@store');

Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');

Route::get('/logout','SessionsController@destroy');

//404
Route::get('/access_denied','PagesController@accessDenied');


//test
Route::group(['middleware'=>'roles','roles'=>['Admin']],function(){
    Route::get('/admin','PagesController@admin');
    Route::post('/add-role','PagesController@add-role');
    Route::post('/stop_comment','PagesController@stop_comment');
    
});
/*
Route::get('/admin',[
    'uses'=>'PagesController@admin',
    'as'=>'content.admin',
    'middleware'=>'roles',
    'roles'=>['admin']
]);
Route::post('/add-role',[
    'uses'=>'PagesController@addrole',
    'as'=>'content.admin',
    'middleware'=>'roles',
    'roles'=>['admin']
]);
*/

Route::group(['middleware'=>'roles','roles'=>['Admin','Editor']],function(){
    Route::get('/editor','PagesController@editor');
    Route::post('/posts/store','PagesController@store');

});
/*
Route::get('/editor',[
    'uses'=>'PagesController@admin',
    'as'=>'content.editor',
    'middleware'=>'roles',
    'roles'=>['admin','editor']
]);
*/

Route::group(['middleware'=>'roles','roles'=>['Admin','Editor','User']],function(){
 Route::post('/like','PagesController@like')->name('like');
 Route::post('/dislike','PagesController@dislike')->name('dislike');

});



Route::get('/statistics','PagesController@statistics');