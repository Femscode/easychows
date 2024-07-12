<?php

use App\Models\User;
use App\Models\Order;
use App\Models\WorkingHour;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\SuperAdmin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodImageController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

// Route::get('/generate', function () {
//     return Str::uuid();
// });
Route::any('countorders',function() {
    return count(Order::all());
});
//route for frontend
Route::any('update_school', function () {
    $users = User::all();
    foreach ($users as $user) {
        if ($user->school == 'FUNAAB') {
            $user->school = 1;
        } elseif ($user->school == 'ILARO-POLY') {
            $user->school = 2;
        } elseif ($user->school == 'FUOYE') {
            $user->school = 3;
        } elseif ($user->school == 'MAPOLY') {
            $user->school = 4;
        } elseif ($user->school == 'OSHIELE') {
            $user->school = 5;
        } elseif ($user->school == 'Lead City University, Ibadan') {
            $user->school = 6;
        }
        $user->save();
    }
});
Route::get('fetch_vendor_email', function() {
    $users = User::latest()->pluck('email')->toArray(); // Fetch all user emails as an array

    $emails = implode(',', $users); // Join the emails using commas

    return $emails; 
});
Route::view('welcome', 'welcome');
Route::view('terms-and-conditions', 'auth.terms');
Route::view('/landing', 'frontend.landing');
Route::view('/about', 'frontend.about');
Route::view('/about-us', 'frontend.about');
Route::view('/logistic_registration', 'auth.logistic_registration');
Route::any('/register_logistic', [RegisteredUserController::class, 'register_logistic'])->name('register_logistic');
Route::get('checksession', function () {
    dd(session()->getId());
});
Route::any('/event-catering/{slug}', [FoodController::class, 'catering'])->name('catering');
Route::any('/runevent', [SchoolController::class, 'runevent'])->name('runevent');

// Route::get('run_working_hours', function() {
//     $users = User::get();
//     foreach($users as $user) {
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Monday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Tuesday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Wednesday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Thursday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Friday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Saturday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);
//         WorkingHour::create([
//             'vendor_id' => $user->id,
//             'day' => "Sunday",
//             'availability' => 1,
//             'opening_hour' => "09:00:00",
//             'closing_hour' => "21:00:00"
//         ]);

//     }
// });

Route::get('/wrap2023', [DashboardController::class, 'wrap_2023'])->name('wrap_2023');
Route::get('/hidden_wrap_2023', [DashboardController::class, 'hidden_wrap_2023'])->name('hidden_wrap_2023');
Route::any('/process_wrap', [DashboardController::class, 'process_wrap'])->name('processWrap');
Route::any('/hiddenwrap', [DashboardController::class, 'hidden_wrap'])->name('hiddenwrap');
Route::any('/mywrap2023', [DashboardController::class, 'process_vendor_wrap'])->name('processVendorWrap')->middleware('auth');
Route::any('/save_preference', [FoodController::class, 'save_preference'])->name('save_preference');
Route::any('/locationquery', [FoodController::class, 'locationquery'])->name('home');
Route::any('/price/{id}/{slug}', [FoodController::class, 'price'])->name('price');
Route::view('/invest', 'frontend.invest');
Route::any('/', [FoodController::class, 'home'])->name('home');
Route::any('/jos-city', [FoodController::class, 'jos'])->name('jos');
Route::any('/viewprofile/{id}', [FoodController::class, 'view_profile'])->name('view_profile');
Route::any('/createreview', [FoodController::class, 'createreview'])->name('createreview');
Route::any('/restaurant/{type}/{food}/{schoolId}', [FoodController::class, 'vendor'])->name('vendor');
Route::any('/selectinstitution', [FoodController::class, 'selectinstitution'])->name('selectinstitution');
Route::any('/searchfood', [FoodController::class, 'searchfood'])->name('searchfood');
Route::any('/changeschool', [FoodController::class, 'changeschool'])->name('changeschool');

Route::any('/addToCart',  [CartController::class, 'addToCart'])->name('addToCart');
Route::any('/addToCart2',  [CartController::class, 'addToCart2'])->name('addToCart2');
Route::any('/addToCart3',  [CartController::class, 'addToCart3'])->name('addToCart3');
Route::any('/menuplate',  [CartController::class, 'menuplate'])->name('menuplate');
Route::any('/deleteplate',  [CartController::class, 'deleteplate'])->name('deleteplate');
//route for plate
Route::any('/addPlate',  [CartController::class, 'addPlate'])->name('addPlate');
Route::any('/multiplyplate',  [CartController::class, 'multiplyplate'])->name('multiplyplate');


Route::any('/removeMenu',  [CartController::class, 'removeMenu'])->name('removeMenu');
Route::any('/removeMenu2',  [CartController::class, 'removeMenu2'])->name('removeMenu2');
Route::any('/cart',  [CartController::class, 'viewCart'])->name('cart');
Route::any('/showcart',  [CartController::class, 'showCart'])->name('showcart');
Route::any('/showCartApi',  [CartController::class, 'showCartApi'])->name('showCartApi');
Route::any('/updatecart', [CartController::class, 'updatecart'])->name('updatecart');
Route::any('/deletecart', [CartController::class, 'deletecart'])->name('deletecart');
Route::any('/cancelcart', [CartController::class, 'cancelcart'])->name('cancelcart');
Route::any('/checkout/{fee}', [OrderController::class, 'checkout'])->name('checkout');
Route::any('/checkout_load_order', [OrderController::class, 'checkout_load_order'])->name('checkout_load_order');
Route::any('/checkout_api/{fee}', [OrderController::class, 'checkout_api'])->name('checkout_api');

//route for orders
Route::group(['middleware' => 'auth:web'], function () {

    Route::post('/update_tracking_time', [DashboardController::class, 'update_tracking_time'])->name('update_tracking_time');
    Route::any('/change_delivery_status/{id}', [DashboardController::class, 'change_delivery_status'])->name('change_delivery_status');
    Route::post('/set_pack_price', [DashboardController::class, 'set_pack_price'])->name('set_pack_price');
    Route::post('/set_group_link', [DashboardController::class, 'set_group_link'])->name('set_group_link');
    Route::post('/set_delivery_price', [DashboardController::class, 'set_delivery_price'])->name('set_delivery_price');
    Route::any('/deletelocation', [DashboardController::class, 'deletelocation'])->name('deletelocation');

    Route::any('/orders', [OrderController::class, 'userorder'])->name('orders');
    Route::any('/today_orders', [OrderController::class, 'today_orders'])->name('today_orders');
    Route::any('/record_day', [OrderController::class, 'record_day'])->name('record_day');
    Route::any('/records', [OrderController::class, 'records'])->name('records');
    Route::any('/transactions', [OrderController::class, 'transactions'])->name('transactions');
    Route::any('/referral_program', [OrderController::class, 'referral_program'])->name('referral_program');
    Route::any('/delivery', [DashboardController::class, 'delivery_location'])->name('delivery_location');
    Route::any('/checkreviews', [OrderController::class, 'checkreviews'])->name('checkreviews');
    Route::any('/orderdetails/{id}', [OrderController::class, 'orderdetails'])->name('orderdetails');
});
Route::view('datatable', 'api.datatable');
//route for api
Route::group(['middleware' => 'auth:web'], function () {

    Route::any('/managers', [ApiUserController::class, 'index'])->name('managers');
    Route::any('/manager_createfood', [ApiUserController::class, 'manager_createfood'])->name('manager_createfood');
    Route::any('/manager_profile', [ApiUserController::class, 'manager_profile'])->name('manager_profile');
    Route::any('/createrestaurant', [ApiUserController::class, 'createrestaurant'])->name('createrestaurant');
    Route::any('/saverestaurant', [ApiUserController::class, 'saverestaurant'])->name('saverestaurant');
    Route::any('/viewrestaurant/{id}', [ApiUserController::class, 'viewrestaurant'])->name('viewrestaurant');
    Route::any('/updaterestaurant', [ApiUserController::class, 'updaterestaurant'])->name('updaterestaurant');
    Route::any('/deleterestaurant/{id}', [ApiUserController::class, 'deleterestaurant'])->name('deleterestaurant');
    Route::any('/managerorder/{id}', [ApiUserController::class, 'userorder'])->name('managerorder');
    Route::any('/managerfood/{id}', [ApiUserController::class, 'userfood'])->name('managerfood');
    Route::any('/managerdisable/{id}', [ApiUserController::class, 'disable'])->name('managerdisable');
    Route::any('/managerprofile/{id}', [ApiUserController::class, 'userprofile'])->name('manageruserprofile');
    Route::any('/managerorderdetails/{id}', [ApiUserController::class, 'orderdetails'])->name('orderdetais');
});

//route for backend
Route::group(['middleware' => 'auth:web'], function () {
    // route for profile

    Route::any('logout', [DashboardController::class, 'logout'])->name('logout');
    Route::any('profile', [SchoolController::class, 'profile'])->name('profile');
    Route::any('myevent', [SchoolController::class, 'myevent'])->name('myevent');
    Route::any('updateevent', [SchoolController::class, 'updateevent'])->name('updateevent');
    Route::post('/saveadditionalimages', [SchoolController::class, 'saveadditionalimages'])->name('saveadditionalimages');
    Route::any('/deleteeventimage/{id}', [SchoolController::class, 'deleteeventimage'])->name('deleteeventtimage');
   
    Route::any('working_hours', [SchoolController::class, 'working_hours'])->name('working_hours');
    Route::any('save_working_hour', [SchoolController::class, 'save_working_hour'])->name('save_working_hour');
    Route::any('payment_info', [SchoolController::class, 'payment_info'])->name('payment_info');
    Route::any('set_withdrawal_pin/{token}', [SchoolController::class, 'set_withdrawal_pin'])->name('set_withdrawal_pin');
    Route::any('reset_withdrawal', [SchoolController::class, 'reset_withdrawal'])->name('reset_withdrawal');
    // Route::any('withdraw', [SchoolController::class, 'withdraw'])->name('withdraw');
    Route::any('withdrawal_pin', [SchoolController::class, 'withdrawal_pin'])->name('withdrawal_pin');
    Route::any('updateprofile', [SchoolController::class, 'updateprofile'])->name('updateprofile');
    Route::any('updateprofile_admin', [SchoolController::class, 'updateprofile_admin'])->name('updateprofile_admin');
    Route::any('confirm_account', [SchoolController::class, 'confirm_account'])->name('confirm_account');
    Route::any('make_transfer', [SchoolController::class, 'make_transfer'])->name('make_transfer');
    //route for category
    Route::any('category', [CategoryController::class, 'index'])->name('category');
    Route::any('createcategory', [CategoryController::class, 'create'])->name('createcategory');
    Route::any('deletecategory', [CategoryController::class, 'destroy'])->name('deletecategory');
    Route::any('editcategory', [CategoryController::class, 'edit'])->name('editcategory');
    Route::any('updatecategory', [CategoryController::class, 'update'])->name('updatecategory');

    //route for food
    Route::any('menu', [FoodController::class, 'index'])->name('food');
    Route::any('createfood', [FoodController::class, 'create'])->name('createfood');
    Route::any('deltefood', [FoodController::class, 'destroy'])->name('deletefood');
    Route::any('editfood', [FoodController::class, 'edit'])->name('editfood');
    Route::any('updatefood', [FoodController::class, 'update'])->name('updatefood');
    Route::any('availability', [FoodController::class, 'availability'])->name('availability');
    Route::any('searchCategory', [FoodController::class, 'searchCategory'])->name('searchCategory');
    Route::any('searchFoodDashboard', [FoodController::class, 'searchFoodDashboard'])->name('searchFoodDashboard');
    Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//route for delivery


Route::get('track_order/{order_id}', [DashboardController::class, 'track_order'])->name('track_order');
Route::group(['middleware' => 'auth:web'], function () {
    Route::any('store_subscription', [DashboardController::class, 'store_subscription'])->name('store_subscription');
    Route::any('run_push', [DashboardController::class, 'run_push'])->name('run_push');
    Route::post('merge_order', [DashboardController::class, 'merge_order'])->name('merge_order');
    Route::post('add_rider', [DashboardController::class, 'add_rider'])->name('add_rider');
    Route::get('delete_rider', [DashboardController::class, 'delete_rider'])->name('delete_rider');
    Route::get('mark_complete', [DashboardController::class, 'mark_complete'])->name('mark_complete');
    Route::get('cancel_order', [DashboardController::class, 'cancel_order'])->name('cancel_order');
    Route::get('delete_delivery', [DashboardController::class, 'delete_delivery'])->name('delete_delivery');
    Route::get('confirm_payment', [DashboardController::class, 'confirm_payment'])->name('confirm_payment');
    Route::get('cttaste_delivery/{id}', [DashboardController::class, 'cttaste_delivery'])->name('cttaste_delivery');
    Route::get('confirm_pickup/{id}', [DashboardController::class, 'confirm_pickup'])->name('confirm_pickup');
    Route::get('clear_rider', [DashboardController::class, 'clear_rider'])->name('clear_rider');
    Route::get('delivery_tracking', [DashboardController::class, 'delivery_tracking'])->name('delivery_tracking');
    Route::post('tracking_type', [DashboardController::class, 'tracking_type'])->name('tracking_type');
});


// Route for the superadmin
Route::group(['middleware' => 'auth:web'], function () {
    Route::any('admin', [SuperAdmin::class, 'index'])->name('super');
    Route::any('lagos_dashboard', [SuperAdmin::class, 'lagos_dashboard'])->name('lagos_dashboard');
    Route::any('uniosun_dashboard', [SuperAdmin::class, 'uniosun_dashboard'])->name('uniosun_dashboard');
    Route::any('oau_dashboard', [SuperAdmin::class, 'oau_dashboard'])->name('oau_dashboard');
    Route::any('fuoye_dashboard', [SuperAdmin::class, 'fuoye_dashboard'])->name('fuoye_dashboard');
    Route::any('vendors', [SuperAdmin::class, 'vendor'])->name('vendor');
    Route::any('view_transaction/{id}', [SuperAdmin::class, 'view_transaction'])->name('view_transaction');
    Route::any('block_user/{id}', [SuperAdmin::class, 'block_user'])->name('block_user');
    Route::any('mark_paid/{id}', [SuperAdmin::class, 'mark_paid'])->name('mark_paid');
    Route::any('promote/{id}', [SuperAdmin::class, 'promote'])->name('promote');

    Route::any('manual_with/{id}', [SuperAdmin::class, 'manual_with'])->name('manual_with');
    Route::any('manual_withdraw', [SuperAdmin::class, 'manual_withdraw'])->name('manual_withdraw');
    Route::any('superadmin', [SuperAdmin::class, 'superadmin'])->name('superadmin');
    Route::any('admin_today', [SuperAdmin::class, 'admin_today'])->name('admin_today');
    Route::any('cashout', [SuperAdmin::class, 'cashout'])->name('cashout');
    Route::any('/contact_gain/', [App\Http\Controllers\SuperAdmin::class, 'contact_gain'])->name('contact_gain');
    Route::any('/downloadCSV/', [App\Http\Controllers\SuperAdmin::class, 'downloadCSV'])->name('downloadCSV');
 
    Route::any('get_weekly_sales/{id}', [SuperAdmin::class, 'get_weekly_sales'])->name('get_weekly_sales');
    Route::any('admin_yesterday', [SuperAdmin::class, 'admin_yesterday'])->name('admin_yesterday');
    Route::any('check_today_vendor', [SuperAdmin::class, 'check_today_vendor'])->name('check_today_vendor');
    Route::any('discount', [SuperAdmin::class, 'discount'])->name('discount');
    Route::any('update_discount_unit', [SuperAdmin::class, 'update_discount_unit'])->name('update_discount_unit');
    Route::any('superuserprofile/{id}', [SuperAdmin::class, 'userprofile'])->name('superuserprofile');
    Route::any('superuserorder/{id}', [SuperAdmin::class, 'userorder'])->name('superuserorder');
    Route::any('supercheckreview/{id}', [SuperAdmin::class, 'checkreview'])->name('supercheckreview');
    Route::any('vendor_order/{id}', [SuperAdmin::class, 'vendor_order'])->name('vendor_order');
    Route::any('superuserfood/{id}', [SuperAdmin::class, 'userfood'])->name('superuserfood');
    Route::any('superworking_hours/{id}', [SuperAdmin::class, 'superworking_hours'])->name('superworking_hours');
    Route::any('update_bonus', [SuperAdmin::class, 'update_bonus'])->name('update_bonus');
    Route::any('update_rank', [SuperAdmin::class, 'update_rank'])->name('update_rank');

    Route::any('makeadmin/{id}', [SuperAdmin::class, 'makeadmin'])->name('makeadmin');
    Route::any('disable/{id}', [SuperAdmin::class, 'disable'])->name('disable');
    Route::any('makevendor/{id}', [SuperAdmin::class, 'makevendor'])->name('makevendor');
    Route::any('approveuser/{id}', [SuperAdmin::class, 'approveuser'])->name('approveuser');
    Route::any('disapproveuser/{id}', [SuperAdmin::class, 'disapproveuser'])->name('disapproveuser');
    Route::any('assignadmin', [SuperAdmin::class, 'assignadmin'])->name('assignadmin');
    Route::any('deleteuser/{id}', [SuperAdmin::class, 'deleteuser'])->name('deleteuser');

    //route for food images
    Route::any('createfoodimage', [FoodImageController::class, 'create'])->name('createfoodimage');
    Route::any('viewfoodimages', [FoodImageController::class, 'view'])->name('foodimage.view');
    Route::any('searchfoodimage', [FoodImageController::class, 'searchfoodimage'])->name('searchfoodimage');
    Route::any('deletefoodimage/{id}', [FoodImageController::class, 'delete'])->name('foodimage.delete');
});




Route::any('{slug}', [FoodController::class, 'restaurant'])->name('restaurant');
require __DIR__ . '/auth.php';
