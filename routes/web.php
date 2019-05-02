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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/Admin', 'AdminController@index')->name('admin');
Route::get('/Admin/list-members', 'UserController@listMembers')->name('list-members');
Route::get('/Admin/add-new-member', 'UserController@getNewMember')->name('add-new-member');
Route::post('/Admin/add-new-member', 'UserController@postNewMember')->name('post-add-new-member');
