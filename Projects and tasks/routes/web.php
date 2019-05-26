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

//use App\Services\Twitter;
use App\Repositories\UserRepositories;

use App\Notifications\SubscriptionRenewalFailed;

Route::get('/', function ()  {
    
    //use notification
    //$user=App\User::first();
    //$user->notify(new SubscriptionRenewalFailed);
    //return 'Done';

    
    return view('welcome');
});

//Route::resource('projects','ProjectsController')->middleware('can:update,project');
Route::resource('projects','ProjectsController');

Route::post('/projects/{project}/tasks','ProjectTasksController@store');
Route::patch('/tasks/{task}','ProjectTasksController@update');


Route::post('/completed-tasks/{task}','CompletedTaskController@store');
Route::delete('/completed-tasks/{task}','CompletedTaskController@destroy');



/*
    GET    /projects        (index)
    GET    /projects/create (create)
    GET    /projects/1      (show)
    GET    /projects/1/edit (edit)
    POST   /projects        (store)
    PATCH  /projects/1      (update)
    DELETE /projects/1      (destroy)
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
