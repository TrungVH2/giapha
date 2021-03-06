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
Route::get('/test-tree', 'HomeController@testTree')->name('test-tree');
Route::get('/tree/setChi', 'UserController@setChi')->name('setChi');

Route::get('/tree', 'HomeController@getTree')->name('tree');
Route::get('/tree/{userId?}/view-detail', 'HomeController@getDetailUser')->name('view-detail-member');
Route::post('/tree/update-sort-number', 'UserController@updateSortInFamily')->name('update-sort-in-family');
Route::get('/event', 'EventController@index')->name('event');
Route::get('/introduction', 'NewsController@introduction')->name('introduction');
Route::get('/rule', 'NewsController@rule')->name('rule');
Route::get('/news/add', 'NewsController@getAddNews')->name('get-add-news');
Route::post('/add-child-wife-husband', 'UserController@postUserSelfAddNewMember')->name('add-child-wife-husband');


Route::get('/Admin', 'AdminController@index')->name('admin');
Route::get('/Admin/list-members', 'UserController@listMembers')->name('list-members');
Route::get('/Admin/add-new-member', 'UserController@getNewMember')->name('add-new-member');
Route::post('/Admin/add-new-member', 'UserController@postNewMember')->name('post-add-new-member');
Route::post('/Admin/get-wife-husband', 'UserController@getWifeHusband')->name('get-wife-husband');
Route::get('/Admin/{userId?}/edit-member', 'UserController@getEditUser')->name('edit-member');
Route::post('/Admin/save-edit-member', 'UserController@postEditUser')->name('save-edit-member');
Route::get('/Admin/{id}/delete', 'UserController@delete')->name('delete');
