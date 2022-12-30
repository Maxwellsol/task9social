<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

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
    return view('auth.login');
})->middleware('guest');

Route::get('users', [UserController::class, 'allUsers'])->name('Users');
Route::get('profile/{id?}', [UserController::class, 'profile'])->name('Profile');


Route::get('user/comments', [CommentController::class, 'index'])->name('UserComments')->middleware('auth');
Route::get('comment/delete/{id}',[CommentController::class, 'delete'])->name('Delete')->middleware('auth');
Route::post('comment/add/{userId}',[CommentController::class, 'store'])->name('AddComment')->middleware('auth');
Route::get('comment/restore/{id}',[CommentController::class, 'restore'])->name('Restore')->middleware('auth');
