<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LeadController
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CallHistoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/overlay-video/{id}', [ApiController::class, 'overlayOnPostVideo']);
Route::post('/overlay-video/{id}', [ApiController::class, 'overlayOnPostVideo']);



// for post methd get-api
Route::post('/insert-category',[ApiController::class,'insertCategory']);
Route::get('/categories', [ApiController::class, 'getAllCategory']);

// function to create user
Route::post('/add-user',[ApiController::class,'createUser']);
Route::get('/show-users',[ApiController::class,'showUsers']);
Route::get('/get_user',[ApiController::class,'getUser']);
Route::get('/get_user_status',[ApiController::class,'userStatus']);   

# function of post
Route::post('add_post',[ApiController::class,'addPost']);  // custom post api
Route::get('show_post',[ApiController::class,'show_post']);
// Route::get('show_post_by_category',[ApiController::class,'show_post_by_category']);
Route::post('custom-post', [ApiController::class, 'customPost']);
Route::get('show_custom_post/{id}', [ApiController::class, 'show_custom_post']);
Route::put('/update_cp/{id}', [ApiController::class, 'updateCustomPost']);





#function of dest
Route::post('/add-dist',[ApiController::class,'addDist']);
Route::get('/show-dist',[ApiController::class,'showDist']);


Route::post('/login', [ApiController::class, 'loginUser']);

Route::get('address/{addressId}', [ApiController::class, 'getAddress']);

# for profile
Route::get('/getProfile/{id}',[ApiController::class, 'getProfile']);
Route::post('/addProfile',[ApiController::class, 'addProfile']);
Route::put('/updateProfile/{id}',[ApiController::class, 'updateProfile']);
Route::get('/contact-us',[ApiController::class, 'contactUs']);

# for plans
Route::post('/addPlans',[ApiController::class, 'addPlans']);
Route::get('/show_plan',[ApiController::class, 'show_plan']);
Route::put('/updatePlans/{id}',[ApiController::class, 'updatePlans']);
# for Subscription
Route::post('/addSubscription',[ApiController::class, 'addSubscription']);
Route::get('/getSubscription',[ApiController::class, 'getSubscription']);
Route::put('/updateSubscription/{id}',[ApiController::class, 'updateSubscription']);

# for State & City
Route::get('/states', [ApiController::class, 'getAllStates']);
Route::get('/cities', [ApiController::class, 'getCitiesByState']);




                                              






