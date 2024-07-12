<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SuperAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\SchoolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::any('/load_order', [App\Http\Controllers\CartController::class, 'showCartApi'])->name('load_order');
Route::any('/load_order', [App\Http\Controllers\CartController::class, 'put_session'])->name('load_order');
Route::any('/process_order', [App\Http\Controllers\OrderController::class, 'processOrder'])->name('process_order');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//API ROUTES FOR THE CT-TASTE MOBILE APP
//registration
Route::any('/register_user', [App\Http\Controllers\Auth\RegisteredUserController::class, 'registerAppUser'])->name('register_user');
Route::any('/login_user', [App\Http\Controllers\ApiAuthController::class, 'login'])->name('login_user');
//Referral Program API
Route::any('/get_new_user', [SchoolController::class, 'getAppUser'])->name('getAppUser');
Route::any('/get_app_users', [SchoolController::class, 'getAllAppUser'])->name('getAllAppUser');
Route::any('/get_single_user/{id}', [SchoolController::class, 'getSingleUser'])->name('getSingleUser');


// Route::group(['middleware' => 'auth:api'], function() {
//processing orders
Route::any('/get_order_details', [App\Http\Controllers\OrderController::class, 'getOrderDetails'])->name('get_order_details');
//get vendors for homepage
Route::any('get_all_vendors', [SchoolController::class, 'get_all_vendors'])->name('get_all_vendors');
Route::any('get_all_vendors/{school_id}', [SchoolController::class, 'get_all_vendors_with_location'])->name('get_all_vendors');
Route::any('get_schools', [SchoolController::class, 'get_schools'])->name('get_schools');
//delivery locations 
Route::any('getlocation/{user_id}', [SchoolController::class, 'get_vendor_location'])->name('get_vendor_location');
Route::any('createlocation', [SchoolController::class, 'create_location_api'])->name('create_location_api');
Route::any('deletelocation/{location_id}', [SchoolController::class, 'delete_location_api'])->name('delete_location_api');
//food menus
Route::any('/get_all_menu/{user_id}', [App\Http\Controllers\SchoolController::class, 'getAllMenu'])->name('get_all_menu');
Route::any('createfood', [FoodController::class, 'create_api'])->name('createfood');
Route::any('deletefood', [FoodController::class, 'destroy_api'])->name('deletefood');
Route::any('updatefood', [FoodController::class, 'update_api'])->name('updatefood');
Route::any('availability', [FoodController::class, 'availability_api'])->name('availability');

// working hours
Route::any('fetch_working_hours/{userId}', [SchoolController::class, 'working_hours_api'])->name('working_hours');
Route::any('update_working_hours/{userId}', [SchoolController::class, 'update_working_hours'])->name('update_working_hours');
//profile
Route::any('updateprofile', [SchoolController::class, 'updateprofile_api'])->name('updateprofile_api');
Route::any('update_pp/{email}/{newPass}', [SchoolController::class, 'update_password'])->name('update_password');
//user_balance
Route::any('update_balance/{userId}/{amount}', [SchoolController::class, 'update_balance'])->name('update_balance');
Route::any('fetch_balance/{userId}', [SchoolController::class, 'fetch_balance'])->name('fetch_balance');
Route::any('fetch_transactions/{userId}', [SchoolController::class, 'fetch_transactions'])->name('fetch_transactions');
//Delete User
Route::any('confirm_delete/{id}', [SuperAdmin::class, 'deleteuser_interface'])->name('deleteuser');
Route::any('deleteuser/{id}', [SuperAdmin::class, 'deleteuser_api'])->name('deleteuser');


//sup_route
Route::any('getfood', [SchoolController::class, 'getfood'])->name('getfood');
// Route::any('getvendors', [SchoolController::class, 'getvendors'])->name('getvendors');
// Route::any('getmenus', [SchoolController::class, 'getmenus'])->name('getmenus');
// Route::any('getlocations', [SchoolController::class, 'getlocations'])->name('getlocations');
// Route::any('getpasswords', [SchoolController::class, 'getpasswords'])->name('getpasswords');
// });