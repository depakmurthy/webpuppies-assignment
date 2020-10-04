<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\RestuarantListController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/friends', [App\Http\Controllers\FriendsController::class, 'index'])->name('friends');

Route::post('save/collection', [App\Http\Controllers\CollectionController::class, 'saveCollection'])->name('save.collection');

Route::post('invite/friends', [App\Http\Controllers\FriendsController::class, 'inviteFriends'])->name('invite.friends');

Route::post('/collection/index', [App\Http\Controllers\CollectionController::class, 'index'])->name('collection');

Route::resource('/collection', CollectionController::class);

Route::get('/collection', [App\Http\Controllers\CollectionController::class, 'index'])->name('collection');

Route::resource('collection',CollectionController::class);

Route::resource('restuarantlist',RestuarantListController::class);

Route::get('column-searching/index', [App\Http\Controllers\RestuarantListController::class, 'index'])->name('column-searching.index');

