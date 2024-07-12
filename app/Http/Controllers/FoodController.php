<?php

namespace App\Http\Controllers;

use Compressor;
use Carbon\Carbon;
use App\Models\Food;
use App\Models\User;
use App\Models\Event;
use App\Models\Order;
use App\Models\Review;
use App\Models\School;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\FoodImage;
use App\Models\Restaurant;
use App\Models\WorkingHour;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DeliveryLocation;
use App\Models\EventAdditionalImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class FoodController extends Controller
{
    public function price($id, $slug)
    {

        $packfee = User::where('id', $id)->firstOrFail()->ct_charge;

        $order_price = Order::where('order_id', $slug)->firstOrFail()->total_price;
        $data['orderId'] = $slug;
        $data['price'] = $price = $order_price;



        return view('frontend.price', $data);
    }
    public function searchCategory(Request $request)
    {
        $val = $request->val;
        $cats = Category::where('name', 'like', '%' . $val . '%')
            ->where('user_id', Auth::user()->id)
            ->limit(5)
            ->get();


        return $cats;
    }
    public function locationquery()
    {
        $delivery = Delivery::get();
        // dd($delivery);
        foreach ($delivery as $del) {
            $user = User::find($del->user_id);
            if ($user !== null) {

                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Harmony',
                    'price' => $del->harmony,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Accord',
                    'price' => $del->accord,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Kofesu',
                    'price' => $del->kofesu,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Isolu',
                    'price' => $del->isolu,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Zoo',
                    'price' => $del->zoo,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Oluwo',
                    'price' => $del->oluwo,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Isolu Cele',
                    'price' => $del->isolu_cele,
                ]);

                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Camp(Surulere)',
                    'price' => $del->camp_surulere,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Camp(Ilupeju)',
                    'price' => $del->camp_ilupeju,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Camp(Apakila)',
                    'price' => $del->camp_apakila,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Camp(Fatola)',
                    'price' => $del->camp_fatola,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Oshiele',
                    'price' => $del->oshiele,
                ]);
                DeliveryLocation::create([
                    'user_id' => $user->id,
                    'name' => 'Ashero',
                    'price' => $del->ashero,
                ]);
            }
            echo ($user);
        }
        $user = User::all();
        dd('jere');
    }
    public function createreview(Request $request)
    {

        $this->validate($request, [
            'complaint' => 'required',
            'restaurant_name' => 'required',
            'phone' => 'required'
        ]);
        $rest_id = User::where('name', $request->restaurant_name)->first();
        if ($rest_id !== null) {

            Review::create([
                'restaurant_name' => $request->restaurant_name,
                'rest_id' => $rest_id->id,
                'complaint' => $request->complaint,
                'phone' => $request->phone
            ]);
            return true;
        }
        Review::create([
            'restaurant_name' => $request->restaurant_name,
            'complaint' => $request->complaint,
            'phone' => $request->phone
        ]);

        return true;
    }
    public function view_profile($id)
    {
        $data['user'] = User::find($id);
        $data['rests'] = User::latest()->where('approve', 1)->where('rank', '<=', 3)->inRandomOrder()->get();
        return view('frontend.profile', $data);
    }
    public function searchFoodDashboard(Request $request)
    {
        $val = $request->val;
        $cats = Food::where('name', 'like', '%' . $val . '%')
            ->where('user_id', Auth::user()->id)
            ->limit(5)
            ->get();
        return $cats;
    }

    public function vendor($type, $food, $schoolId)
    {
        // $data['mylocation'] = School::where('id',$schoolId)->first();
        // $data['schools'] = School::get();

        // $data['message'] = 'Hi';
        if ($type == 'Best') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->where('rank', '<=', 3)->limit(12)->inRandomOrder()->get();
        } else if ($type == 'Trending') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->orderBy('rank')->limit(12)->inRandomOrder()->get();
        } else if ($type == 'New') {
            $data['rests'] = User::latest()->where('approve', 1)->where('school', $schoolId)->limit(12)->get();
        } else if ($type == 'Cheap') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->where('rank', '>=', 3)->inRandomOrder()->get();
        } else if ($type == 'food' || $type == 'Fried-and-Jollof-rice' || $type == 'Bread-and-Beans' || $type == 'swallow') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->where('restaurant_category', 'food')->inRandomOrder()->get();
        } else if ($type == 'cakes') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->where('restaurant_category', 'cakes')->inRandomOrder()->get();
        } else if ($type == 'Shawarma-and-Pizza') {
            $data['rests'] = User::where('approve', 1)->where('school', $schoolId)->where('restaurant_category', 'shawarma')->inRandomOrder()->get();
        } else {
            $data['rests'] = User::where('restaurant_category', $food)->where('school',  $schoolId)->where('approve', 1)->inRandomOrder()->limit(12)->get();
        }
        $data['type'] = $type;
        $data['school'] = School::find($schoolId);

        // $data['restaurants'] = $data['rests'];
        // $data['locId'] = 1;

        return view('frontend.vendors2', $data);
        return view('frontend.vendors', $data);
    }
    public function searchfood(Request $request)
    {
        // dd($request->all());
        $current_time = now()->format('H:i:s');
        $data['schools'] = School::all();
       

        $current_time = now(); // Assuming you have the current time calculated
        $current_day = strtolower($current_time->format('l')); // Get the lowercase day name

        $foods = Food::where('name', 'like', '%' . $request->food . '%')->pluck('user_id');
        $data['locId'] = $locId = session()->get('user_location', null);
        // dd($locId);
        if ($locId == null) {
            $data['mylocation'] = School::find(1);
        } else {
            $data['mylocation'] = School::find($locId);
        }



        // $locations = User::where('id',);
        $data['restaurants'] = $res = User::whereIn('id', $foods)->where('school', $request->school)->where('approve', 1)->orderBy('rank')->paginate(20);
        $data['schools'] = School::all();
        $data['message'] = true;
        $data['food'] = $request->food;
        $data['promoted'] = User::where('approve', 1)
        ->where('school', $locId)
        ->where('promoted', 1)
        ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
            $query->where('day', $current_day)
                ->where('availability', 1)
                ->whereTime('opening_hour', '<=', $current_time)
                ->whereTime('closing_hour', '>=', $current_time);
        })
        ->orderBy('rank', 'asc')
        ->inRandomOrder()
        ->limit(4)
        ->get();

    $restpromoted = User::where('approve', 1)
        ->where('school', $locId)
        ->where('promoted', 1)
        ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
            $query->where('day', $current_day)
                ->where('availability', 1)
                ->whereTime('opening_hour', '<=', $current_time)
                ->whereTime('closing_hour', '>=', $current_time);
        })
       
        ->inRandomOrder()
        ->first();
    $data['promotestatus'] = 0;
    if ($restpromoted !== null) {
        $data['promotestatus'] = 1;


        if (substr($restpromoted->image, 0, 5) == 'https') {
            $data['promotedimage'] = $restpromoted->image; // Replace 'your_prefix' with the desired string to prepend
        } else {
            $data['promotedimage'] = 'https://cttaste.com/cttaste_files/public/profilePic/' . $restpromoted->image; // Replace 'your_prefix' with the desired string to prepend

        }

        $data['promotedslug'] = $restpromoted->slug;
        $data['promotedname'] = $restpromoted->name;
    }

        return view('frontend.home', $data)->with('message', 'List of restaurants based on your search');
    }

    public function changeschool(Request $request)
    {
        $today =  Carbon::now()->format('l');
        session()->forget('user_location');
        // session()->put('user_location',$request->school, now()->addWeek());
        session()->put('user_location', $request->school);
        $locId = session()->get('user_location', null);
        // dd($locId);
        $data['restaurants'] = $res = User::where('school', $request->school)->where('approve', 1)
            ->with(['working_hour' => function ($query) use ($today) {
                $query->where('day', $today);
            }])
            ->orderBy('rank')->get();
        // dd($res);
        return $res;
    }

    public function home()
    {
        $current_time = now()->format('H:i:s');
        $data['schools'] = School::all();
        // $auth_user = 
        // dd(User::first()->working_hour);

        $current_time = now(); // Assuming you have the current time calculated
        $current_day = strtolower($current_time->format('l')); // Get the lowercase day name

        $capitalized_day = ucfirst($current_day);
        // dd($capitalized_day);
        $data['locId'] = $locId = session()->get('user_location', null);
        // dd($locId);
        if ($locId == null) {
            $data['mylocation'] = School::find(1);
            $data['restaurants'] = User::where('approve', 1)
                ->where('school', 1)
                ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                    $query->where('day', $current_day)
                        ->orderBy('opening_hour', 'asc');
                }])
                ->orderBy('rank', 'asc')
                ->paginate(20);
        } else {
            $data['mylocation'] = School::find($locId);
            $data['restaurants'] = User::where('approve', 1)
                ->where('promoted', 0)
                ->where('school', $locId)
                ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                    $query->where('day', $current_day)
                        ->orderBy('opening_hour', 'asc');
                }])
                ->orderBy('rank', 'asc')
                ->paginate(20);
        }


        //this works harshly
        // $data['restaurants'] = User::where('approve', 1)
        //     ->where('school', $locId)
        //     ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
        //         $query->where('day', $current_day)
        //             ->where('availability', 1)
        //             ->whereTime('opening_hour', '<=', $current_time)
        //             ->whereTime('closing_hour', '>=', $current_time);
        //     })
        //     ->orderBy('rank', 'asc')
        //     ->paginate(20);

        



        $data['promoted'] = User::where('approve', 1)
            ->where('school', $locId)
            ->where('promoted', 1)
            ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->where('availability', 1)
                    ->whereTime('opening_hour', '<=', $current_time)
                    ->whereTime('closing_hour', '>=', $current_time);
            })
            ->orderBy('rank', 'asc')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $restpromoted = User::where('approve', 1)
            ->where('school', $locId)
            ->where('promoted', 1)
            ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->where('availability', 1)
                    ->whereTime('opening_hour', '<=', $current_time)
                    ->whereTime('closing_hour', '>=', $current_time);
            })
           
            ->inRandomOrder()
            ->first();
        $data['promotestatus'] = 0;
        if ($restpromoted !== null) {
            $data['promotestatus'] = 1;


            if (substr($restpromoted->image, 0, 5) == 'https') {
                $data['promotedimage'] = $restpromoted->image; // Replace 'your_prefix' with the desired string to prepend
            } else {
                $data['promotedimage'] = 'https://cttaste.com/cttaste_files/public/profilePic/' . $restpromoted->image; // Replace 'your_prefix' with the desired string to prepend

            }

            $data['promotedslug'] = $restpromoted->slug;
            $data['promotedname'] = $restpromoted->name;
        }





        // previous code
        // $data['restaurants'] = $rest = User::where('approve', 1)
        //     ->where('school', 'Funaab')
        //     ->with('working_hour') 
        //     ->orderByRaw("CASE WHEN working_hour.opening_hour <= ? AND working_hour.closing_hour >= ? THEN 0 ELSE 1 END, rank ASC", [$current_time, $current_time])
        //     ->paginate(20);
        $data['message'] = false;
        $data['food'] = '';
        
        return view('frontend.home', $data);
    }
    public function jos()
    {
        $current_time = now()->format('H:i:s');
        $data['schools'] = School::all();
        // $auth_user = 
        // dd(User::first()->working_hour);

        $current_time = now(); // Assuming you have the current time calculated
        $current_day = strtolower($current_time->format('l')); // Get the lowercase day name

        $capitalized_day = ucfirst($current_day);
        // dd($capitalized_day);
        $data['restaurants'] = User::where('approve', 1)
            ->where('school', 8)
            ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->orderBy('opening_hour', 'asc');
            }])
            ->orderBy('rank', 'asc')
            ->paginate(20);

        //this works harshly
        // $data['restaurants'] = User::where('approve', 1)
        // ->where('school', 'Funaab')
        // ->whereHas('working_hour', function ($query) use ($current_day, $current_time) {
        //     $query->where('day', $current_day)
        //           ->where('availability', 1)
        //           ->whereTime('opening_hour', '<=', $current_time)
        //           ->whereTime('closing_hour', '>=', $current_time);
        // })
        // ->orderBy('rank', 'asc')
        // ->paginate(20);


        // previous code
        // $data['restaurants'] = $rest = User::where('approve', 1)
        //     ->where('school', 'Funaab')
        //     ->with('working_hour') 
        //     ->orderByRaw("CASE WHEN working_hour.opening_hour <= ? AND working_hour.closing_hour >= ? THEN 0 ELSE 1 END, rank ASC", [$current_time, $current_time])
        //     ->paginate(20);
        $data['message'] = false;
        $data['food'] = '';
        return view('frontend.jos', $data);
    }
    public function save_preference(Request $request)
    {
        $session = serialize(session()->all());
        // dd($session);
        $response = Http::post('https://fastpay.cttaste.com/api/save_preference', [
            'cart' => $request->cart,
            'name' => $request->preference_name,
            'email' => $request->email_address,
            'session' => $session
        ]);
        return $response;
    }
    public function selectinstitution()
    {

        $data['restaurants'] = User::where('approve', 1)->get();
        $data['schools'] = School::all();
        // dd($data['schools']);
        return view('frontend.selectinstitution', $data);
    }
    public function restaurant($slug)
    {

        $data['rest'] = $rest = User::where('slug', $slug)->first();
        $data['reviews'] = Review::where('rest_id', $rest->id)->latest()->take(5)->get();
        $data['schools'] = School::all();
       

        $data['others'] = $others = User::where('school', $rest->school)->orderBy('rank')->paginate(10);

        $timestamp = time(); // Current timestamp
        $today = date("l", $timestamp);
        $working_day = WorkingHour::where('vendor_id', $rest->id)->where('day', $today)->firstOrFail();
        if (Auth::user()) {


            if (session()->has('cart')) {
                if ($rest->id !== session()->get('cart')->restaurant) {
                    // session()->forget('cart');
                    session()->flush();
                }
            }
            if (session()->has('cart')) {
                $c_plate = session()->get('cart')->items;
                $plate = 1;
                foreach ($c_plate as $d) {
                    $pp = $d['plate'];
                    // dd($pp,session()->get('cart'));
                    foreach ($pp as $c) {
                        if ($c > $plate) {
                            $plate = $c;
                        }
                    }
                }
                $data['plate'] = $plate;
            } else {
                $data['plate'] = null;
            }
            $data['menus'] = $food = Food::where('user_id', $rest->id)->where('available', 1)->orderBy('rank', 'asc')->get();

            $data['cats'] = $cat = Category::where('user_id', $rest->id)->orderBy('rank', 'asc')->get();
            // dd($food);
            if ($rest->user_type == 'api_vendor') {

                $data['vendor_image'] = User::find($rest->assigned)->first()->image;
                return view('frontend.menu_api', $data);
            } else {
                return view('frontend.menu', $data);
            }
        } elseif ($rest->approve == 0 || $working_day->availability == 0 || (!(Carbon::now()->format('H:i') > $working_day->opening_hour &&  Carbon::now()->format('H:i') < $working_day->closing_hour))) {

            return redirect()->route('home');
        } else {



            if (session()->has('cart')) {
                if ($rest->id !== session()->get('cart')->restaurant) {
                    // session()->forget('cart');
                    session()->flush();
                }
            }
            if (session()->has('cart')) {
                $c_plate = session()->get('cart')->items;
                $plate = 1;
                foreach ($c_plate as $d) {
                    $pp = $d['plate'];
                    // dd($pp,session()->get('cart'));
                    foreach ($pp as $c) {
                        if ($c > $plate) {
                            $plate = $c;
                        }
                    }
                }
                $data['plate'] = $plate;
            } else {
                $data['plate'] = null;
            }
            $data['menus'] = $food = Food::where('user_id', $rest->id)->where('available', 1)->orderBy('rank', 'asc')->get();
            // dd($food);
            $data['cats'] = $cat = Category::where('user_id', $rest->id)->orderBy('rank', 'asc')->get();
            // dd($food);
            

            if ($rest->user_type == 'api_vendor') {

                $data['vendor_image'] = User::find($rest->assigned)->first()->image;
                return view('frontend.menu_api', $data);
            } else {
                return view('frontend.menu', $data);
            }
        }
    }

    public function catering($slug) {
        $data['user'] = $user = User::where('slug',$slug)->first();
        $data['event'] = $event = Event::where('user_id',$user->id)->firstOrFail();
        $data['menus'] = Food::where('user_id', $user->id)->where('rank', '<=', 5)->get();
        $data['additionalimages'] = EventAdditionalImage::where('event_id',$event->id)->get();
        return view('frontend.catering',$data);
       
    }

    public function availability(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $food = Food::find($id);
        if ($status == 'false') {
            $food->available = 1;
            $food->save();

            return true;
        } else {

            $food->available = 0;
            $food->save();
            return false;
        }
        //update food availability on the app
        $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/' . $food->id . '/updateFoodStatus/');
        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonEnc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            // 'Content-Length: ' . strlen($jsonEnc)
        ));
        $response = curl_exec($ch);
        $response_json = json_decode($response, true);
        dd($response_json);
    }
    public function availability_api(Request $request)
    {
        try {
            $this->validate($request, ['food_id' => 'required']);
            $id = $request->food_id;


            $food = Food::find($id);
            if ($food->available == 0) {
                $food->available = 1;
                $food->save();
            } else {
                $food->available = 0;
                $food->save();
            }
            $foods = Food::where('user_id', $food->user_id)->orderBy('rank')->get();
            $foods->map(function ($foods) {
                if (substr($foods->image, 0, 5) == 'https') {

                    $foods->image = $foods->image; // Replace 'your_prefix' with the desired string to prepend
                } else {

                    $foods->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $foods->image; // Replace 'your_prefix' with the desired string to prepend

                }
                return $foods;
            });
            $response = [
                'success' => true,
                'message' => 'Food Availability Updated Successfully!',
                'data' => $foods
            ];
            return response()->json($response);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }
    public function index()
    {
        $data['foods'] = Food::where('user_id', Auth::user()->id)->orderBy('rank', 'asc')->get();
        $data['categories'] = Category::where('user_id', Auth::user()->id)->orderBy('rank', 'asc')->get();
        $data['foodimages'] = FoodImage::latest()->get();
        $data['active'] = 'food';
        $data['user'] = Auth::user();
        return view('dashboard.menu', $data);
        return view('newdashboard.food', $data);
       
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required'],
            'category_id' => ['required']
        ]);
        $user = Auth::user();
        $userId = $request->userId;
        
        if($userId == null) {
            $userId = $user->id;
        }
        
        $check = Food::where('name', $request->name)->where('category_id', $request->category_id)->where('user_id', $user->id)->get();
        if ($check->isEmpty()) {

            if ($request->has('image')) {
                $image = $request->image;
                $imagename = $image->hashName();
                $img = Compressor::make($image->path());
                $good = $img->resize(250, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('foodimages') . '/' . $imagename);
                $category = Category::where('id', $request->category_id)->first()->name;

                $food =  Food::create([
                    'user_id' => $userId,
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'price' => $request->price,
                    'image' => $imagename
                ]);
            } else {
                $food =  Food::create([
                    'user_id' => $userId,
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'price' => $request->price,
                ]);
            }
            return $food;


            //Creating food from the api
            $jsonEnc = json_encode([

                "name" => $request->name,
                "image_url" => "https://cttaste.com/cttaste_files/public/foodimages/" . $food->image,
                "price" => $request->price,
                "available" => true
            ]);
            $uuid = Str::uuid();
            $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/' . $user->id . '/createFood/');

            // Set cURL options
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonEnc);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonEnc)
            ));

            // Execute cURL session and store the response
            $response = curl_exec($ch);

            $response_json = json_decode($response, true);
            dd($response_json);
        }
    }
    public function create_api(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => ['required'],
                'user_id' => ['required'],
                'price' => ['required'],
                // 'category_id' => ['required']
            ]);
            $check = Food::where('name', $request->name)->where('user_id', $request->user_id)->get();
            if ($check->isEmpty()) {

                if ($request->has('image')) {
                    $image = $request->image;
                    $food =  Food::create([
                        'user_id' => $request->user_id,
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'image' => $image
                    ]);
                } else {
                    $food =  Food::create([
                        'user_id' => $request->user_id,
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                    ]);
                }
                $foods = Food::where('user_id', $request->user_id)->orderBy('rank')->get();
                $foods->map(function ($foods) {
                    if (substr($foods->image, 0, 5) == 'https') {

                        $foods->image = $foods->image; // Replace 'your_prefix' with the desired string to prepend
                    } else {

                        $foods->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $foods->image; // Replace 'your_prefix' with the desired string to prepend

                    }
                    return $foods;
                });
                $response = [
                    'success' => true,
                    'message' => 'Food Created Successfully!',
                    'data' => $foods
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }
    public function create_api_token(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => ['required'],
                'user_id' => 'required',
                'price' => ['required'],
                'category_id' => ['required']
            ]);
            $check = Food::where('name', $request->name)->where('user_id', $request->user_id)->get();
            if ($check->isEmpty()) {

                if ($request->has('image')) {
                    $image = $request->image;
                    $imagename = $image->hashName();
                    $img = Compressor::make($image->path());
                    $good = $img->resize(250, 150, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('foodimages') . '/' . $imagename);
                    $category = Category::where('id', $request->category_id)->first()->name;

                    $food =  Food::create([
                        'user_id' => $request->user_id,
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'image' => $imagename
                    ]);
                } else {
                    $food =  Food::create([
                        'user_id' => Auth::user()->id,
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                    ]);
                }
                $response = [
                    'success' => true,
                    'message' => 'Food Created Successfully!',
                    'data' => $food
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $food = Food::find($id);
        $food->delete();

        return "Food deleted successfully";

        //delete food on the app
        $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/' . $food->id . '/deleteFood/');
        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonEnc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            // 'Content-Length: ' . strlen($jsonEnc)
        ));
        $response = curl_exec($ch);
        $response_json = json_decode($response, true);
        dd($response_json);
    }
    public function destroy_api(Request $request)
    {
        try {
            // dd($request->all(), $request->food_id);
            // $this->validate($request, ['food_id', 'required']);
            $id = $request->food_id;
            $food = Food::find($id);
            $user_id = $food->user_id;
            $food->delete();
            $foods = Food::where('user_id', $user_id)->orderBy('rank')->get();
            $foods->map(function ($foods) {
                if (substr($foods->image, 0, 5) == 'https') {

                    $foods->image = $foods->image; // Replace 'your_prefix' with the desired string to prepend
                } else {

                    $foods->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $foods->image; // Replace 'your_prefix' with the desired string to prepend

                }
                return $foods;
            });

            $response = [
                'success' => true,
                'message' => 'Food Deleted Successfully!',
                'data' => $foods
            ];
            return response()->json($response);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $food = Food::find($id);
        return $food;
    }
    public function update(Request $request)

    {

        $this->validate($request, [
            'name' => ['required'],
            'id' => ['required'],
            'category_id' => ['required'],
            'price' => ['required'],

        ]);


        $food = Food::find($request->id);


        if ($request->image !== 'undefined') {

            $pathname = public_path() . '/foodimages/' . $food->image;
            // dd(strlen($food->image));
            if (file_exists($pathname) && $food->image != null && strlen($food->image) >= 44) {
                unlink($pathname);
            }
            $food->name = $request->name;
            $food->price = $request->price;
            $food->category_id = $request->category_id;
            $food->quantity = $request->quantity;

            $image = $request->image;
            $imagename = $image->hashName();
            $image->move(public_path() . '/foodimages/', $imagename);
            $food->image = $imagename;
            $food->save();


            $category = Category::where('id', $request->category_id)->first()->name;
        } else {
            $food->name = $request->name;
            $food->price = $request->price;
            $food->category_id = $request->category_id;
            $food->quantity = $request->quantity;
            $food->save();
        }
        return $food;

        //Update food from the api
        $jsonEnc = json_encode([

            "name" => $request->name,
            "image_url" => "https://cttaste.com/cttaste_files/public/foodimages/" . $food->image,
            "price" => $request->price,
            "available" => true
        ]);
        $uuid = Str::uuid();
        $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/' . $food->id . '/updateFood/');

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonEnc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonEnc)
        ));

        // Execute cURL session and store the response
        $response = curl_exec($ch);

        $response_json = json_decode($response, true);
        dd($response_json);
    }
    public function update_api(Request $request)

    {
        try {
            $this->validate($request, [
                'name' => ['required'],
                'food_id' => ['required'],
                'category_id' => ['required'],
                'price' => ['required'],
            ]);
            $food = Food::find($request->food_id);
            if (strlen($request->image) > 5) {
                $food->name = $request->name;
                $food->price = $request->price;
                $food->category_id = $request->category_id;
                $image = $request->image;
                $food->image = $image;
                $food->save();
                // $category = Category::where('id', $request->category_id)->first()->name;
            } else {
                $food->name = $request->name;
                $food->price = $request->price;
                $food->category_id = $request->category_id;
                $food->save();
            }
            $foods = Food::where('user_id', $food->user_id)->orderBy('rank')->get();
            $foods->map(function ($foods) {
                if (substr($foods->image, 0, 5) == 'https') {

                    $foods->image = $foods->image; // Replace 'your_prefix' with the desired string to prepend
                } else {

                    $foods->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $foods->image; // Replace 'your_prefix' with the desired string to prepend

                }
                return $foods;
            });
            $response = [
                'success' => true,
                'message' => 'Food Updated Successfully!',
                'data' => $foods
            ];
            return response()->json($response);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }
}
