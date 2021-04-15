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

Auth::routes([
        'login' => false,
        'register' => false,
    ]
);

//Route::get('/', 'frontend\Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('/user/store', 'frontend\DashboardController@store')->name('user.register');

//User Login Route are here
Route::get('/', 'frontend\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login/user', 'frontend\Auth\LoginController@login')->name('login.user');
Route::post('/logout/user', 'frontend\Auth\LoginController@logout')->name('logout.user');

//Dashboard route are here
Route::get('/home', 'frontend\DashboardController@index')->name('index');
Route::get('/profile', 'frontend\DashboardController@profile')->name('user.profile');
Route::get('/polls/index', 'frontend\PollController@showpoll')->name('user.polls.index');

//Survey route are here
Route::get('/surveys/{poll}', 'frontend\PollController@showsurvey')->name('user.polls.survey');
Route::post('/surveys/{poll}', 'frontend\PollController@store')->name('user.polls.survey.store');
//comment route are here
Route::post('/comments/{poll}', 'frontend\PollController@commentstore')->name('user.survey.comment.store');

/*
|----------------------------------------------
    backend route are here
|-----------------------------------------------
*/
Route::get('/auth/{social}','backend\Auth\SocialLoginController@socialLogin')->where('social','facebook|google');
Route::get('/auth/{social}/callback','backend\Auth\SocialLoginController@handleProviderCallback')->where('social','facebook|google');
/*z
|----------------------------------------------
    Supper admin route are here
|-----------------------------------------------
*/
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'backend\DashboardController@index')->name('admin.dashboard');
    Route::get('/profile', 'backend\DashboardController@profile')->name('admin.profile');
    Route::get('/search', 'backend\DashboardController@poll_search')->name('poll.search');
    Route::resource('roles', 'backend\RolesController', ['names'=>'admin.roles']);
    Route::resource('admins', 'backend\AdminsController', ['names'=>'admin.admins']);
    Route::resource('users', 'backend\UserController', ['names'=>'admin.users']);

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

    //question route are here
    Route::get('/polls/questions/index', 'backend\QuestionController@index')->name('admin.polls.question.index');
    Route::get('/polls/{poll}/questions/create', 'backend\QuestionController@create');
    Route::post('/polls/{poll}/question', 'backend\QuestionController@store');
    Route::get('/polls/{poll}/questions/{question}/edit', 'backend\QuestionController@edit');
    Route::post('/polls/{poll}/questions/{question}/update', 'backend\QuestionController@update');
    Route::delete('/polls/{poll}/questions/{question}', 'backend\QuestionController@destroy');
    Route::get('/poll/{pid}/question/{qid}/statistics', 'backend\PollsController@statistics')->name('admin.poll.statistics');
    Route::post('/poll/question/statistics', 'backend\PollsController@statisticsByCategory');
    Route::post('/poll/question/statistics/category', 'backend\PollsController@statisticsCategory');

    //survey route are here
    Route::get('/surveys/{poll}-{slug}', 'backend\SurveyController@show');
    Route::post('/surveys/{poll}-{slug}', 'backend\SurveyController@store');
    //comment route are here
    Route::post('/comments/{poll}', 'backend\CommentsController@store')->name('comment.store');
    Route::get('/comments/index', 'backend\CommentsController@index')->name('admin.comment.index');
    Route::delete('/comments/{id}', 'backend\CommentsController@destory')->name('admin.comment.destory');



    /*----------------------------------------------
        App Setting route are here
    |-----------------------------------------------*/

    Route::get('/app-setting/socialite', 'backend\SocialiteController@index')->name('admin.socialite.index');
    Route::put('/app-setting/socialite/{id}/update', 'backend\SocialiteController@update')->name('admin.socialite.update');

    /*----------------------------------------------
        Login and Logout route are here
    |-----------------------------------------------*/
    Route::get('/login', 'backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::get('/survey/login', 'backend\Auth\LoginController@showSurveyLoginForm')->name('admin.survey.login');
    Route::post('/login/submit', 'backend\Auth\LoginController@login')->name('admin.login.submit');

    //Logout Route are here
    Route::post('/logout/submit', 'backend\Auth\LoginController@logout')->name('admin.logout.submit');

    //Forget password Route are here
    //Route::get('/password/reset', 'backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    //Route::post('/password/reset/submit', 'backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
