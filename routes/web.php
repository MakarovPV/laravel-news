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

Route::get('/', [App\Http\Controllers\News\NewsController::class, 'index'])->name('news.index');

Route::get('/news/{id}', [App\Http\Controllers\News\NewsCommentsController::class, 'index'])->name('news.comments.index');
Route::post('/news/{id}', [App\Http\Controllers\News\NewsCommentsController::class, 'store'])->name('news.comments.store');

Route::get('/forum', [App\Http\Controllers\Forum\ForumCategoriesController::class, 'index'])->name('forum.categories.index');

Route::get('/forum/{id}', [App\Http\Controllers\Forum\ForumSubcategoriesController::class, 'index'])->name('forum.subcategories.index');
Route::get('/forum/{id}/create', [App\Http\Controllers\Forum\ForumSubcategoriesController::class, 'create'])->name('forum.subcategories.create');
Route::post('/forum/{id}', [App\Http\Controllers\Forum\ForumSubcategoriesController::class, 'store'])->name('forum.subcategories.store');

Route::get('/forum/{id}/{catId}', [App\Http\Controllers\Forum\ForumSubcategoriesCommentsController::class, 'index'])->name('forum.subcategories.comments.index');
Route::post('/forum/{id}/{catId}', [App\Http\Controllers\Forum\ForumSubcategoriesCommentsController::class, 'store'])->name('forum.subcategories.comments.store');

Route::get('/user/{id}', [App\Http\Controllers\User\UserController::class, 'getProfile'])->name('user.getProfile');
Route::get('/user/{id}/edit', [App\Http\Controllers\User\UserController::class, 'edit'])->name('user.edit');
Route::post('/user/{id}/edit', [App\Http\Controllers\User\UserController::class, 'updatePassword'])->name('user.updatePassword');

Auth::routes();

Route::get('/home', function () {
    return redirect('/');
});


Route::prefix("/admin")->middleware('admin')->group(function(){
	Route::get('news', [App\Http\Controllers\Admin\News\NewsController::class, 'index'])->name('admin.news.index');
	Route::get('news/create', [App\Http\Controllers\Admin\News\NewsController::class, 'create'])->name('admin.news.create');
	Route::post('news/create', [App\Http\Controllers\Admin\News\NewsController::class, 'store'])->name('admin.news.store');
	Route::delete('news/{id}', [App\Http\Controllers\Admin\News\NewsController::class, 'destroy'])->name('admin.news.destroy');

	Route::get('news/{id}', [App\Http\Controllers\Admin\News\NewsCommentsController::class, 'index'])->name('admin.news.comments.index');
	Route::post('news/{id}', [App\Http\Controllers\Admin\News\NewsCommentsController::class, 'store'])->name('admin.news.comments.store');
	Route::delete('news/{newsId}/{commentId}', [App\Http\Controllers\Admin\News\NewsCommentsController::class, 'destroy'])->name('admin.news.comments.destroy');

	Route::get('/forum', [App\Http\Controllers\Admin\Forum\ForumCategoriesController::class, 'index'])->name('admin.forum.categories.index');

	Route::get('/forum/{id}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesController::class, 'index'])->name('admin.forum.subcategories.index');
	Route::get('/forum/{id}/create', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesController::class, 'create'])->name('admin.forum.subcategories.create');
	Route::post('/forum/{id}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesController::class, 'store'])->name('admin.forum.subcategories.store');
	Route::delete('/forum/{id}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesController::class, 'destroy'])->name('admin.forum.subcategories.destroy');

	Route::get('/forum/{id}/{catId}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesCommentsController::class, 'index'])->name('admin.forum.subcategories.comments.index');
	Route::post('/forum/{id}/{catId}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesCommentsController::class, 'store'])->name('admin.forum.subcategories.comments.store');
	Route::delete('/forum/{id}/{catId}', [App\Http\Controllers\Admin\Forum\ForumSubcategoriesCommentsController::class, 'destroy'])->name('admin.forum.subcategories.comments.destroy');

	Route::get('/user/{id}', [App\Http\Controllers\Admin\User\UserController::class, 'getProfile'])->name('admin.user.getProfile');
	Route::post('/user/{id}', [App\Http\Controllers\Admin\User\UserController::class, 'banUser'])->name('admin.user.banUser');
});
