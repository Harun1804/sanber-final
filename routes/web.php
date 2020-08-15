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

Route::get('/', function () {
    return view('welcome');
});

//Auth
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/validasi', 'AuthController@validation')->name('validasi');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/register', 'AuthController@makeAccount')->name('daftar');
Route::get('/logout', 'AuthController@logout')->name('logout');



Route::group(['middleware' => ['auth']], function () {
    //dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //own Question
    Route::resource('/ownquestion', 'PertanyaanController');
    Route::get('/forum', 'PertanyaanController@forum')->name('forum');
    Route::get('/forum/{id}/detail', 'ForumController@detail')->name('forum.detail');
    Route::post('/forum-pertanyaan', 'VoteController@votePertanyaan')->name('forum.vote.pertanyaan');
    Route::post('/forum-jawaban', 'VoteController@voteJawaban')->name('forum.vote.jawaban');
    Route::post('/komentar_pertanyaan', 'KomentarController@store')->name('komenper');
    Route::post('/komentar_jawaban', 'KomentarController@koJaw')->name('komenjaw');
    Route::post('/jawaban-pertanyaan', 'JawabanController@store')->name('forum.create.jawaban');
});
