<?php

use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Comments\CommentController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\UserProfile\UserProfileController;
use App\Http\Controllers\Users\UserController;
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
    return view('frontend.welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    // PREFIX Admin panel
    Route::prefix('/cp-admin')->group(function () {

        // Strona główna Dashboard
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // File Manager
        Route::get('/filemanager', [FileManagerController::class, 'index'])->name('file-manager');

        //Pages
        Route::get('/pages', [PageController::class, 'index'])->name('pages');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages/create', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.delete');
        Route::post('/pages/{page}/update', [PageController::class, 'update'])->name('pages.update');

        //Posts
        Route::get('/posts', [PostController::class, 'index'])->name('posts');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');
        Route::post('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');


        //Profile
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile-user');
        Route::post('/profile', [UserProfileController::class, 'update_avatar'])->name('profile-avatar');
        Route::post('/profile/update-name', [UserProfileController::class, 'updateName'])->name('update-name');
        Route::get('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/profile/change-password', [UserProfileController::class, 'updatePassword'])->name('update-password');

        //Users
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');

        //Categories
        Route::get('/categories', [CategoryController::class, 'allCategories'])->name('allCategories');
        Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
        Route::any('/category/{id}/edit/', [CategoryController::class, 'editCategory'])->name('editCategory');
        Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');

        //Comments
        Route::get('/comments', [CommentController::class, 'index'])->name('comments');

    });
});




// FRONTEND
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');