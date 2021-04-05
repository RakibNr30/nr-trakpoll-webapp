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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

//Route::get('/', 'frontend\Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('/user/store', 'frontend\DashboardController@store')->name('user.register');
Route::get('/', 'frontend\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login/user', 'frontend\Auth\LoginController@login')->name('login.user');
Route::post('/logout/user', 'frontend\Auth\LoginController@logout')->name('logout.user');


Route::get('/home', 'frontend\DashboardController@index')->name('index');
Route::get('/polls/index', 'frontend\PollController@showpoll')->name('user.polls.index');

/*
|----------------------------------------------
    backend route are here
|-----------------------------------------------
*/ 

/*
|----------------------------------------------
    Supper admin route are here
|-----------------------------------------------
*/ 
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'backend\DashboardController@index')->name('admin.dashboard');
    Route::get('/search', 'backend\DashboardController@poll_search')->name('poll.search');
	//Route::get('/', 'backend\ChartDataController@getAllQuestions');
    Route::resource('roles', 'backend\RolesController', ['names'=>'admin.roles']);
    Route::resource('admins', 'backend\AdminsController', ['names'=>'admin.admins']);
    Route::resource('users', 'backend\UsersController', ['names'=>'admin.users']);

    /*----------------------------------------------
        Polls route route are here
    |-----------------------------------------------*/ 
    Route::get('/polls/index', 'backend\PollsController@index')->name('admin.polls.index');
    Route::get('/polls/create', 'backend\PollsController@create')->name('admin.polls.create');
    Route::post('/polls', 'backend\PollsController@store')->name('admin.polls.store');
    Route::get('/polls/{poll}', 'backend\PollsController@show');
    Route::get('/polls/{poll}/edit', 'backend\PollsController@edit');
    Route::post('/polls/{poll}/update', 'backend\PollsController@update');
    Route::delete('/polls/{poll}/questions/', 'backend\PollsController@destroy');
    Route::get('/poll_approved/{id}', 'backend\PollsController@poll_approved')->name('admin.poll.approved');
    Route::get('/poll_disapproved/{id}', 'backend\PollsController@poll_disapproved')->name('admin.poll.disapproved');

    //Route::get('/deactive_product/{id}','backend\ProductController@deactive_product')->name('admin.product.deactiveproduct');
    //Route::get('/active_product/{id}','backend\ProductController@active_product')->name('admin.product.activeproduct');


    //question route are here
    Route::get('/polls/{poll}/questions/create', 'backend\QuestionController@create');
    Route::post('/polls/{poll}/question', 'backend\QuestionController@store');
    Route::get('/polls/{poll}/questions/{question}/edit', 'backend\QuestionController@edit');
    Route::post('/polls/{poll}/questions/{question}/update', 'backend\QuestionController@update');
    Route::delete('/polls/{poll}/questions/{question}', 'backend\QuestionController@destroy');

    //survey route are here
    Route::get('/surveys/{poll}-{slug}', 'backend\SurveyController@show');
    Route::post('/surveys/{poll}-{slug}', 'backend\SurveyController@store');
    //comment route are here
    Route::post('/comments/{poll}', 'backend\CommentsController@store')->name('comment.store');
    Route::get('/comments/index', 'backend\CommentsController@index')->name('admin.comment.index');
    Route::delete('/comments/{id}', 'backend\CommentsController@destory')->name('admin.comment.destory');


    
    /*----------------------------------------------
        Login and Logout route are here
    |-----------------------------------------------*/ 
    Route::get('/login', 'backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'backend\Auth\LoginController@login')->name('admin.login.submit');

    //Logout Route are here
    Route::post('/logout/submit', 'backend\Auth\LoginController@logout')->name('admin.logout.submit');

    //Forget password Route are here
    //Route::get('/password/reset', 'backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    //Route::post('/password/reset/submit', 'backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');

});
