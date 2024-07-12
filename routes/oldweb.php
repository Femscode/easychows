<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FoodImageController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
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

// Route::get('/', function () {
//     return view('frontend.home');
// });
//route for frontend
Route::view('welcome','welcome');
Route::view('landing','frontend.landing');
Route::view('vendor','frontend.landing');
Route::view('/invest','frontend.invest');
Route::get('allmails', function() {
    if(Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'awealexander7@gmail.com') {
        $user = User::latest()->pluck('email');
        $firi = json_encode($user);
        $therest = str_replace(['{','"','[',']'], '', $firi);
        
        return $therest;
    }
    else {
        return redirect('home');
    }
})->middleware('auth');
Route::get('topuser', function() {
    if(Auth::user()->email == 'fasanyafemi@gmail.com') {
       $user = DB::table('orders')->select('phone', DB::raw('COUNT(phone) AS occurrences'))
            ->groupBy('phone')
            ->orderBy('occurrences', 'DESC')
            ->limit(15)
            ->get();
             $firi = json_encode($user);
        $top = str_replace(['{','"','[',']','occurrences','phone','}',':'], '', $firi);
        return $top;
       
    }
    else {
        return redirect('home');
    }
})->middleware('auth');

Route::any('/viewprofile/{id}', [FoodController::class, 'view_profile'])->name('view_profile');
Route::any('/createreview', [FoodController::class, 'createreview'])->name('createreview');

Route::any('/restaurant/{type}/{food}', [FoodController::class, 'vendor'])->name('vendor');
Route::any('testmail',function() {
    $data = array("name"=>"fasanya");
       Mail::send('mail.welcome', $data, function($message) {
         $message->to('fasanyafemi@gmail.com', '')->subject
            ('Testing mails');
         $message->from('support@cttaste.com','CTtaste');
      });
      return 'mail sent';
});
Route::any('/', [FoodController::class, 'home'])->name('home');
Route::any('/selectinstitution', [FoodController::class, 'selectinstitution'])->name('selectinstitution');
Route::any('/searchfood', [FoodController::class, 'searchfood'])->name('searchfood');
Route::any('/changeschool', [FoodController::class, 'changeschool'])->name('changeschool');

Route::any('/addToCart/{food}',  [CartController::class, 'addToCart'])->name('addToCart');
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
Route::any('/updatecart',[CartController::class,'updatecart'])->name('updatecart');
Route::any('/deletecart',[CartController::class,'deletecart'])->name('deletecart');
Route::any('/cancelcart',[CartController::class,'cancelcart'])->name('cancelcart');
Route::any('/checkout/{fee}',[OrderController::class,'checkout'])->name('checkout');

//route for orders
Route::group(['middleware' => 'auth'], function() {
Route::any('/orders',[OrderController::class,'userorder'])->name('orders');
Route::any('/record_day',[OrderController::class,'record_day'])->name('record_day');
Route::any('/records',[OrderController::class,'records'])->name('records');
Route::any('/orderdetails/{id}',[OrderController::class,'orderdetails'])->name('orderdetails');
});

//route for backend
Route::group(['middleware' => 'auth'], function() {
// route for profile

Route::any('logout', [DashboardController::class, 'logout'])->name('logout');

Route::any('/set_pack_price', [DashboardController::class, 'set_pack_price'])->middleware(['auth'])->name('set_pack_price');

Route::any('/set_delivery_price', [DashboardController::class, 'set_delivery_price'])->middleware(['auth'])->name('set_delivery_price');
Route::any('profile', [SchoolController::class, 'profile'])->name('profile');
Route::any('updateprofile', [SchoolController::class, 'updateprofile'])->name('updateprofile');
    //route for category
Route::any('category', [CategoryController::class, 'index'])->name('category');
Route::any('createcategory', [CategoryController::class, 'create'])->name('createcategory');
Route::any('deletecategory', [CategoryController::class, 'destroy'])->name('deletecategory');
Route::any('editcategory', [CategoryController::class, 'edit'])->name('editcategory');
Route::any('updatecategory', [CategoryController::class, 'update'])->name('updatecategory');

//route for food
Route::any('food', [FoodController::class, 'index'])->name('food');
Route::any('createfood', [FoodController::class, 'create'])->name('createfood');
Route::any('deltefood', [FoodController::class, 'destroy'])->name('deletefood');
Route::any('editfood', [FoodController::class, 'edit'])->name('editfood');
Route::any('updatefood', [FoodController::class, 'update'])->name('updatefood');
Route::any('availability', [FoodController::class, 'availability'])->name('availability');
Route::any('dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::any('searchCategory', [FoodController::class, 'searchCategory'])->name('searchCategory');
Route::any('searchFoodDashboard', [FoodController::class, 'searchFoodDashboard'])->name('searchFoodDashboard');
} );


// Route for the superadmin
Route::group(['middleware' => 'auth'],function() { 
Route::any('super', [SuperAdmin::class, 'index'])->name('super');
Route::any('superadmin', [SuperAdmin::class, 'index'])->name('super');
Route::any('superuserprofile/{id}', [SuperAdmin::class, 'userprofile'])->name('superuserprofile');
Route::any('superuserorder/{id}', [SuperAdmin::class, 'userorder'])->name('superuserorder');
Route::any('superuserfood/{id}', [SuperAdmin::class, 'userfood'])->name('superuserfood');
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



// Route for the admin
Route::group(['middleware' => 'auth'],function() { 
    Route::any('admindashboard', [SuperAdmin::class, 'admindashboard'])->name('admindashboard');
    Route::any('userprofile/{id}', [SuperAdmin::class, 'userprofile'])->name('superuserprofile');
    Route::any('userorder/{id}', [SuperAdmin::class, 'userorder'])->name('superuserorder');
    Route::any('userfood/{id}', [SuperAdmin::class, 'userfood'])->name('superuserfood');
    });
    

Route::any('{slug}', [FoodController::class, 'restaurant'])->name('restaurant');
require __DIR__.'/auth.php';
