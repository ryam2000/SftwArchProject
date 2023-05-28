<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Basic routes
Route::redirect('/', '/home');
Route::view('/home', 'pages.home');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/contacts', function () {
    return view('pages.contacts');
})->name('contacts');
Route::get('redirects', App\Http\Controllers\HomeController::class);

Route::resource('home', App\Http\Controllers\PostsController::class);
Route::resource('posts', App\Http\Controllers\ShowController::class);
Route::resource('postlike', App\Http\Controllers\PostLikesController::class);
Route::resource('commentlike', App\Http\Controllers\CommentLikesController::class);

//Admin routes
Route::group(['middleware' => ['role:administrator']], function () {
    Route::redirect('/admin', '/dashboard');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('admin/posts', App\Http\Controllers\Admin\PostsController::class);
    Route::get('admin/posts-dt', [App\Http\Controllers\Admin\PostsController::class, 'dt']);
    Route::resource('admin/comments', App\Http\Controllers\Admin\CommentsController::class);
    Route::resource('admin/users', App\Http\Controllers\Admin\UsersController::class);
    Route::resource('admin/roles', App\Http\Controllers\Admin\RolesController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
]);
