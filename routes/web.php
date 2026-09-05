<?php

use App\Http\Controllers\Admin\UploadImageController;
use App\Http\Controllers\User\AjaxUploadController;
use App\Http\Controllers\User\PodcastController;
use App\Http\Controllers\User\AlbumController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitePodcastController;
use App\Http\Controllers\SubscribersController;
use Illuminate\Support\Facades\Auth;
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

// Site Routes
Route::get('/', [IndexController::class, 'index'])->name('homepage');
Route::get('/subscribe', [SubscribersController::class, 'store'])->name('subscribe');
Route::get('/podcasts', [SitePodcastController::class, 'index'])->name('podcasts');
Route::post('/podcast/{id}/like', [SitePodcastController::class, 'toggleLike'])->name('podcast.like');
Route::get('/albums', [\App\Http\Controllers\AlbumController::class, 'index'])->name('albums');
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/category/{id}', [\App\Http\Controllers\CategoryController::class, 'show']);
Route::get('/album/{id}', [\App\Http\Controllers\AlbumController::class, 'show']);
Route::post('/comment/store', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::post('/download/update', [SitePodcastController::class, 'update'])->name('download.update');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::post('/search/result', [SearchController::class, 'search'])->name('find');
Route::post('/search/advanced/result', [SearchController::class, 'advancedSearch'])->name('advanced');
Route::get('/recommendations', [\App\Http\Controllers\RecommendationController::class, 'index'])->name('recommendations')->middleware('auth');

Auth::routes();

// User Profile Routes
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('is_user');
Route::resource('dashboard/podcast', PodcastController::class)->middleware('is_user');
Route::resource('dashboard/album', AlbumController::class)->middleware('is_user');
Route::resource('dashboard/profile', ProfileController::class)->middleware('is_user');
Route::get('/ajax_upload', [AjaxUploadController::class, 'index']);
Route::post('/ajax_upload/action', [AjaxUploadController::class, 'action'])->name('ajaxupload.action');

// Admin Routes
Route::get('/administrator', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin-dashboard')->middleware('is_admin');
Route::resource('administrator/podcasts', \App\Http\Controllers\Admin\ManagePodcastController::class)->middleware('is_admin');
Route::get('administrator/podcasts/{podcast}/approve', [\App\Http\Controllers\Admin\ManagePodcastController::class, 'approve'])->name('podcasts.approve')->middleware('is_admin');
Route::resource('administrator/albums', \App\Http\Controllers\Admin\ManageAlbumController::class)->middleware('is_admin');
Route::resource('administrator/categories', \App\Http\Controllers\Admin\ManageCategoryController::class)->middleware('is_admin');
Route::resource('administrator/users', \App\Http\Controllers\Admin\ManageUserController::class)->middleware('is_admin');
Route::resource('administrator/comments', \App\Http\Controllers\Admin\ManageCommentController::class)->middleware('is_admin');
Route::get('administrator/comments/{podcast}/approve', [\App\Http\Controllers\Admin\ManageCommentController::class, 'approve'])->name('comments.approve')->middleware('is_admin');
Route::resource('administrator/profile-setting', \App\Http\Controllers\Admin\AdminProfileController::class)->middleware('is_admin');
Route::get('/admin_image_upload', [UploadImageController::class, 'index']);
Route::post('/admin_image_upload/action', [UploadImageController::class, 'action'])->name('ajax.action');