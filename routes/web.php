<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DistController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;


use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('/', function () {
    return redirect(route('login'));
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

#Add middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CommonController::class, 'dash'])->name('dashboard');

// Category Routes
Route::get('/category', [CategoryController::class, 'showCategroy'])->name('category.show');

Route::get('/adding-category', [CategoryController::class, 'addCategroy'])->name('adding-category');
Route::post('/create-category', [CategoryController::class, 'createCategroy'])->name('create-category');

Route::get('/edit-category/{id}', [CategoryController::class, 'editCategroy'])->name('edit-category');
Route::post('/update-category/{id}', [CategoryController::class, 'updateCategroy'])->name('update-category');

Route::get('/cat', [CategoryController::class, 'index'])->name('user.index'); 
Route::delete('/cat/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::post('/update-cat-status', [CategoryController::class, 'updateStatus'])->name('update-cat-status');




Route::get('get-post', [CategoryController::class, 'getPost'])->name('get-post');

////// Users Route
Route::get('/add-user', [UserController::class, 'addUser'])->name('add-user');
Route::post('/insert-user', [UserController::class, 'insertUser'])->name('insert-user');
Route::get('/show-user', [UserController::class, 'showUser'])->name('show-user');
#login
Route::get('/login-page', [UserController::class, 'login'])->name('login-page');
Route::post('/login', [UserController::class, 'loginUser'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');


////////////// for active button //////
Route::post('/update-distributor-status', [UserController::class, 'updateStatus'])->name('update-distributor-status');

Route::get('/view-user/{id}',[UserController::class, 'viewUserDetails'])->name('view-user');
Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('edit-user');
Route::post('/update-user/{id}', [UserController::class, 'updateUser'])->name('update-user');
Route::post('/active-user/{id}', [UserController::class, 'activeUser'])->name('active-user');


Route::get('/users', [UserController::class, 'index'])->name('user.index'); // List users
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

////////////////////////////////////////////////////////////////////////////////////////////
#post routes
Route::get('/show-post', [PostController::class, 'showPost'])->name('show-post');
Route::get('/show-video', [PostController::class, 'showVideo'])->name('show-video');
#add
Route::get('/addCp', [PostController::class, 'addCp'])->name('addCp');
Route::post('/insert_cp', [PostController::class, 'storeCustomPost'])->name('insert_cp');

Route::get('/add-post', [PostController::class, 'addPost'])->name('add-post');
Route::post('/insert-post', [PostController::class, 'insertPost'])->name('insert-post');
Route::get('/posts', [PostController::class, 'index'])->name('user.index'); // List users
Route::delete('/delete-post/{id}', [PostController::class, 'destroyPost'])->name('delete-post');
Route::get('/videos', [PostController::class, 'indexVid'])->name('user.index'); 
Route::delete('/delete-video/{id}', [PostController::class, 'destroyVideo'])->name('delete-video');
// Route::get('/filter-posts', [PostController::class, 'filterPosts'])->name('filter-posts');

# distributor routes
Route::get('/add-dist', [DistController::class, 'addDist'])->name('add-dist');
Route::post('/insert-dist', [DistController::class, 'insertDist'])->name('insert-dist');
#show dist route
Route::get('/show-dist', [DistController::class, 'showDist'])->name('show-dist');
////////////// for active button //////
Route::post('/update-distributor-status', [DistController::class, 'updateStatus'])->name('update-distributor-status');

////////////////////////////////////////
Route::get('/edit-dist/{id}', [DistController::class, 'editDist'])->name('edit-dist');
Route::post('/update-dist/{id}', [DistController::class, 'updateDist'])->name('update-dist');
#delete
Route::get('/distributors', [DistController::class, 'index'])->name('distributors'); 
Route::delete('/distributors/{id}', [DistController::class, 'destroy'])->name('distributor-destroy');
#view
Route::get('/dist-details/{id}',[DistController::class, 'viewDistDetails'])->name('dist-details');


// Define the route for updating the distributor's active status
Route::post('/update_dist/{id}', [DistController::class, 'updateDists'])->name('update_dist');

    #Plans
Route::get('/add-plan', [PlanController::class, 'addPlan'])->name('adding-plan');
Route::post('/create-plan', [PlanController::class, 'createPlan'])->name('create-plan');
Route::get('/show_plans', [PlanController::class, 'showPlans'])->name('show_plans');
Route::post('/update-status/{id}', [PlanController::class, 'updateStatus'])->name('update-plan-status');
Route::get('/edit_plan/{id}', [PlanController::class, 'editPlans'])->name('edit_plan');
Route::post('/update_plan/{id}', [PlanController::class, 'updatePlans'])->name('update_plan');
Route::get('/plans', [PlanController::class, 'index'])->name('show_plans');
Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plan.destroy');

Route::get('/plan/show', [PlanController::class, 'planView'])->name('plan.show');









});

require __DIR__.'/auth.php';