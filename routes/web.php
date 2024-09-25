<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\UserController;
use App\Models\Course;
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

Route::get('/',[FrontController::class , 'index'])->name('index');
Route::post('/contact', [ReclamationController::class, 'store'])->name('contact.store');

// routes/web.php

Route::middleware(['auth'])->group(function () {
     // Routes for admin role
     Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/coachs', [CoachController::class, 'coachs'])->name('admin.coachs.index');
        Route::delete('/coachs/{id}', [CoachController::class, 'destroy'])->name('coachs.destroy');
        Route::get('/createcoachs', [CoachController::class, 'create'])->name('coachs.create');
        Route::post('/coachscreate', [CoachController::class, 'store'])->name('coachs.store');
        Route::get('/users', [UserController::class, 'users'])->name('admin.users.index');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/createusers', [UserController::class, 'create'])->name('users.create');
        Route::post('/userscreate', [UserController::class, 'store'])->name('users.store');
        Route::get('/reclamations' , [ReclamationController::class , 'reclamations'])->name('admin.reclamations');
        Route::get('/reclamations/{id}', [ReclamationController::class, 'show'])->name('admin.reclamations.show');
        Route::delete('/reclamations/{id}', [ReclamationController::class, 'delete'])->name('admin.reclamations.delete');

    });

    // Routes for coach role
    Route::middleware(['role:coach'])->prefix('coach')->group(function () {
        Route::get('/home', [CoachController::class, 'index'])->name('coach.dashboard');
        Route::get('/startcourse' , [CourseController::class , 'index'])->name('startcourse');
        Route::post('/createcourse' , [CourseController::class , 'store'])->name('courses.store');
    });

    // Routes for user role
    Route::middleware(['role:user'])->prefix('user')->group(function () {
        Route::get('/home', [UserController::class, 'index'])->name('user.dashboard');
    });
      // Routes accessibles par tous les rôles
           //profile manager
      Route::get('/profile/{id}', [ProfileController::class, 'profile'])->name('profile');
      Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('user.update');
      Route::put('/profile/updatePersonalInfo/{id}', [ProfileController::class, 'updatePersonalInfo'])->name('user.updatePersonalInfo');
      Route::put('/profile/changePassword/{id}', [ProfileController::class, 'changePassword'])->name('user.changePassword');
      Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('user.delete');

      Route::get('/coachs/{id}', [CoachController::class, 'show'])->name('coachs.show');
      Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

      Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
      Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');

      Route::get('/createpost', [PostController::class , 'create'])->name('createpost');
      Route::get('/post/{id}', [PostController::class , 'show'])->name('viewpost');
      Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');


      Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
      Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
      Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
      Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');



});

require __DIR__.'/auth.php';
