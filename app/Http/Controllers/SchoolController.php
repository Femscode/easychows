<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Food;
use App\Models\User;
use App\Models\Event;
use App\Models\School;
use App\Models\Transaction;
use App\Models\WorkingHour;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DeliveryLocation;
use Illuminate\Support\Facades\DB;
use App\Models\EventAdditionalImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    public function profile()
    {
        $data['user'] = $user = Auth::user();
        $data['rest'] = $user;
        $data['schools'] = School::all();
        $data['active'] = 'profile';
        return view('dashboard.profile', $data);
        return view('newdashboard.profile', $data);
       
    }

    public function runevent()
    {
        $users = User::where('approve', 1)->get();
        foreach ($users as $user) {
            $event = Event::where('user_id', $user->id)->first();
            $randomDescriptions = [
                "Our catering service specializes in providing delicious and diverse menus for a variety of events, including weddings, corporate gatherings, and private parties. With our attention to detail and dedication to exceptional service, we ensure that every event is a memorable culinary experience for our clients and their guests.",
                "Indulge in our catering service's diverse menus, perfect for weddings, corporate functions, and private gatherings. With our commitment to excellence, every event becomes a culinary delight for all.",
                "Elevate your event with our catering service's delectable offerings. From weddings to corporate affairs, we ensure every moment is filled with exquisite flavors and exceptional service.",
                "Experience culinary excellence with our catering service, tailored for weddings, corporate events, and intimate gatherings. Our dedication to detail guarantees an unforgettable dining experience.",
                "Impress your guests with our catering service's dynamic menus, designed for weddings, corporate events, and social gatherings. With our personalized touch, every occasion is a culinary masterpiece.",
                "Discover the art of fine dining with our catering service, curated for weddings, corporate functions, and private parties. From elegant presentations to mouthwatering flavors, we redefine event catering."
            ];

            // Select a random description
            $randomDescription = $randomDescriptions[array_rand($randomDescriptions)];
            if (!$event) {
                Event::create([
                    'user_id' => $user->id,
                    'title' => $randomDescription,
                    // "description" => "You can also book us for"
                ]);
            }
        }
    }
    public function myevent()
    {

        $data['user'] = $user = Auth::user();
        $event = Event::where('user_id', $user->id)->first();
        $randomDescriptions = [
            "Our catering service specializes in providing delicious and diverse menus for a variety of events, including weddings, corporate gatherings, and private parties. With our attention to detail and dedication to exceptional service, we ensure that every event is a memorable culinary experience for our clients and their guests.",
            "Indulge in our catering service's diverse menus, perfect for weddings, corporate functions, and private gatherings. With our commitment to excellence, every event becomes a culinary delight for all.",
            "Elevate your event with our catering service's delectable offerings. From weddings to corporate affairs, we ensure every moment is filled with exquisite flavors and exceptional service.",
            "Experience culinary excellence with our catering service, tailored for weddings, corporate events, and intimate gatherings. Our dedication to detail guarantees an unforgettable dining experience.",
            "Impress your guests with our catering service's dynamic menus, designed for weddings, corporate events, and social gatherings. With our personalized touch, every occasion is a culinary masterpiece.",
            "Discover the art of fine dining with our catering service, curated for weddings, corporate functions, and private parties. From elegant presentations to mouthwatering flavors, we redefine event catering."
        ];

        // Select a random description
        $randomDescription = $randomDescriptions[array_rand($randomDescriptions)];
        if (!$event) {
            Event::create([
                'user_id' => $user->id,
                'title' => $randomDescription,
                // "description" => "You can also book us for"
            ]);
        }
        $data['rest'] = $user;
        $data['schools'] = School::all();
        $data['active'] = 'profile';
        $data['event'] = $event = Event::where('user_id', $user->id)->first();
        $data['additionalimages'] = EventAdditionalImage::where('event_id', $event->id)->get();
        return view('newdashboard.event', $data);
    }
    public function updateevent(Request $request)
    {

        $data['user'] = $user = Auth::user();
        $event = Event::where('id', $request->eventId)->firstOrFail();
        $event->title = $request->title;
        if ($request->has('image')) {
            if ($event->display_image !== null) {
                $oldImage = public_path('event_image') . '/' . $event->display_image;
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image = $request->image;
            $imageName = $image->hashName();
            $image->move(public_path() . '/event_image', $imageName);
            $event->display_image = $imageName;
        }
        $event->save();


        $data['rest'] = $user;
        $data['schools'] = School::all();
        $data['active'] = 'event';

        return redirect()->back()->with('message', 'Event Catering Details Updated Successfully!');
    }

    public function saveadditionalimages(Request $request)
    {
        $data['user'] = Auth::user();
        $data['active'] = 'event';
        $this->validate($request, ['id' => 'required', 'images' => 'required']);
        $data['event'] = $event = Event::find($request->id);
        $previouscount = EventAdditionalImage::where('event_id', $event->id)->count();
        $currentcount = count($request->images);
        $total = $previouscount + $currentcount;

        if ($total > 10) {
            return redirect()->back()->with('error', 'Event images must not be more than ten(10)!');
        }
        foreach ($request->images as $img) {

            $imageName = $img->hashName();
            $img->move(public_path('event_additional_image'), $imageName);
            EventAdditionalImage::create(['event_id' => $event->id, 'image' => $imageName]);
        }

        return redirect()->back()->with('message', 'Event additional images added successfully!');
    }
    public function deleteeventimage($id)
    {
        $data['user'] = Auth::user();
        $data['active'] = 'event';

        $additionalimage = EventAdditionalImage::find($id);
        $previousImagePath = public_path('event_additional_image') . '/' . $additionalimage->image;
        if (file_exists($previousImagePath)) {
            unlink($previousImagePath);
        }
        $additionalimage->delete();

        return redirect()->back()->with('message', 'Event additional image deleted successfully!');
    }
    public function working_hours()
    {
        $data['user'] = $user = Auth::user();
        $data['rest'] = $user;
        $data['active'] = 'profile';
        $data['working_hours'] = WorkingHour::where('vendor_id', $user->id)->get();

        if ($data['working_hours']->isEmpty()) {
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Monday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Tuesday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Wednesday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Thursday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Friday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Saturday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
            WorkingHour::create([
                'vendor_id' => $user->id,
                'day' => "Sunday",
                'availability' => 1,
                'opening_hour' => "09:00:00",
                'closing_hour' => "21:00:00"
            ]);
        }
        $data['working_hours'] = WorkingHour::where('vendor_id', $user->id)->get();

        return view('dashboard.working_hours', $data);
    }
    public function working_hours_api($user_id)
    {
        // dd('here');
        try {
            $user = User::find($user_id);
            $data['working_hours'] = WorkingHour::where('vendor_id', $user->id)->get();

            if ($data['working_hours']->isEmpty()) {
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Monday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Tuesday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Wednesday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Thursday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Friday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Saturday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
                WorkingHour::create([
                    'vendor_id' => $user->id,
                    'day' => "Sunday",
                    'availability' => 1,
                    'opening_hour' => "09:00:00",
                    'closing_hour' => "21:00:00"
                ]);
            }


            $data =  WorkingHour::where('vendor_id', $user_id)->get();
            $formattedData = $data->map(function ($item) {
                $item->opening_hour = Carbon::parse($item->opening_hour)->format('H:i');
                $item->closing_hour = Carbon::parse($item->closing_hour)->format('H:i');
                return $item;
            });
            return response()->json($formattedData);

            $response = [
                'success' => true,
                'message' => 'Working hours fetched!',
                'data' => $data
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
    public function save_working_hour(Request $request)
    {
        $data = $request->data;
        // dd($request->all(), $data);
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if (strpos($key, 'opening_hour-') === 0) {
                $id = substr($key, strlen('opening_hour-'));
                $workingHour = WorkingHour::find($id);
                if ($workingHour) {
                    $openingHour = $requestData["opening_hour-$id"];
                    $closingHour = $requestData["closing_hour-$id"];
                    $availability = isset($requestData["availability-$id"]) && $requestData["availability-$id"] === "on" ? true : false;
                    // dd($closingHour,$availability);

                    // Perform any validation if needed
                    if ($openingHour < $closingHour) {
                        $workingHour->update([
                            'opening_hour' => $openingHour,
                            'closing_hour' => $closingHour,
                            'availability' => $availability
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Working Hours Updated Successfully!');
    }
    public function update_working_hours(Request $request, $user_id)
    {
        // $this->validate($request, ['data' => 'required']);
        // dd($request->all());
        // $data = '[{"id":50,"vendor_id":1,"day":"Monday","availability":1,"opening_hour":"11:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":51,"vendor_id":1,"day":"Tuesday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":52,"vendor_id":1,"day":"Wednesday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":53,"vendor_id":1,"day":"Thursday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":54,"vendor_id":1,"day":"Friday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":55,"vendor_id":1,"day":"Saturday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"},{"id":56,"vendor_id":1,"day":"Sunday","availability":1,"opening_hour":"09:00:00","closing_hour":"21:00:00","created_at":"2023-10-29T19:58:23.000000Z","updated_at":"2023-10-29T19:58:23.000000Z"}]';
        try {
            $data = $request->data;
            $workingHoursData = json_decode($data, true); // Convert the JSON data to an array
            // dd($workingHoursData,$data);
            foreach ($workingHoursData as $workingHour) {
                // Find the WorkingHour record by its 'id'
                $workingHourModel = WorkingHour::find($workingHour['id']);

                if ($workingHourModel) {
                    // Update the fields you want to change
                    $workingHourModel->availability = $workingHour['availability'];
                    $workingHourModel->opening_hour = $workingHour['opening_hour'];
                    $workingHourModel->closing_hour = $workingHour['closing_hour'];

                    // Save the changes
                    $workingHourModel->save();
                }
            }
            $data =  WorkingHour::where('vendor_id', $user_id)->get();
            $formattedData = $data->map(function ($item) {
                $item->opening_hour = Carbon::parse($item->opening_hour)->format('H:i');
                $item->closing_hour = Carbon::parse($item->closing_hour)->format('H:i');
                return $item;
            });
            return response()->json($formattedData);
        } catch (\Exception $e) {

            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response);
        }
    }



    public function set_withdrawal_pin($token)
    {
        $data['user'] = Auth::user();
        $data['active'] = 'change_pin';
        $data['token'] = $token;
        return view('newdashboard.setpin', $data);
    }
    public function reset_withdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'new_pin' => 'required|integer',
            'confirm_pin' => 'required|integer',
        ]);
        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid parameters');
        }
        if (!session()->has('resetpin')) {
            return redirect()->back()->with('error', 'Token Expired');
        }
        $user = Auth::user();
        // dd($request->all());
        if ($request->new_pin == $request->confirm_pin) {
            $user->pin =  hash('sha256', $request->new_pin);
            $user->save();
            session()->remove('resetpin');
            return redirect()->route('dashboard')->with('message', 'Pin updated successfully');
        } else {
            return redirect()->back()->with('error', 'Incorrect pin/ unmatched pin');
        }
    }


    public function withdrawal_pin()
    {
        $user = Auth::user();
        $token = Str::random(14);
        $data = array('user' => $user, 'token' => $token);
        session()->remove('resetpin');
        session()->put('resetpin', $token, 5);
        Mail::send('mail.withdrawal_pin', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Reset Your Pin');
            // $message->to($user->email)->subject('Reset Your Pin');
            $message->from('support@cttaste.com', 'CT_Taste');
        });
        return true;
    }
    public function payment_info()
    {
        $data['user'] = Auth::user();
        $data['rest'] = Auth::user();
        $data['active'] = 'profile';
        return view('newdashboard.payment_info', $data);
        return view('backend.profile', $data);
    }
    public function confirm_account(Request $request)
    {
        // dd($request->all());
        $url = "https://api.paystack.co/transferrecipient";

        $fields = [
            'type' => "nuban",
            'name' => "",
            'account_number' => $request->account_no,
            'bank_code' => $request->bank_code,
            'currency' => "NGN"
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer sk_live_dc09eacf4aed817703251640abf8bd4b4f0d007f",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        $res_json = json_decode($result, true);
        if ($res_json['status'] == true) {
            return $res_json;
        }
        return false;
        dd($res_json);
    }
    public function make_transfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);
        $user = Auth::user();
        $user_pin = $request->first . $request->second . $request->third . $request->fourth;

        $hashed_pin = hash('sha256', $user_pin);
        if ($user->pin !== $hashed_pin) {
            $response = [
                'success' => false,
                'message' => 'Incorrect Pin',

            ];

            return response()->json($response);
        }
        $amount = ($request->amount * 100);
        //the pin validation here;

        if ($user->balance < $request->amount) {
            $response = [
                'success' => false,
                'message' => 'Insufficient Balance',

            ];

            return response()->json($response);
        }
        if ($user->block == 1) {
            $response = [
                'success' => false,
                'message' => 'Unable to withdraw for security reasons, please contact 09058744473',

            ];

            return response()->json($response);
        }
        $url = "https://api.paystack.co/transfer";
        $reference = 'my-unique-reference-' . strtolower(preg_replace('/[0-9]/', '', Str::random(3)));

        $fields = [
            'source' => "balance",
            'amount' => $amount,
            "reference" => $reference,
            'recipient' => $request->recipient_code,
            'reason' => "CT_TASTE VENDOR PAYOUT"
        ];
        // dd($request->all(),$fields,env('PAYSTACK_SECRET_KEY'));

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        $res_json = json_decode($result, true);

        if ($res_json['status'] == true) {
            $details = "Withdraw of NGN " . $request->amount . " to " . $request->account_name . ". Account Number :" . $request->account_no;
            $amount = intval($request->amount);
            Transaction::create([
                'title' => 'Funds Withdraw',
                'rest_id' => $user->id,
                'details' => $details,
                'reference' => $reference,
                'type' => 'debit',
                'status' => 1,
                'amount' => $amount,
                'before_balance' => $user->balance,
                'after_balance' => $user->balance - $amount,
            ]);
            $user->balance -= $amount;
            $user->save();

            return $res_json;
        } else {
            $details = "Failed Withdraw of NGN " . $request->amount . " to " . $request->account_name . ". Account Number :" . $request->account_no;

            Transaction::create([
                'title' => 'Funds Withdraw',
                'rest_id' => $user->id,
                'details' => $details,
                'reference' => $reference,
                'type' => 'debit',
                'status' => 0,
                'amount' => $amount,
                'before_balance' => $user->balance,
                'after_balance' => $user->balance,
            ]);

            return $res_json;
        }
        return false;
        dd($res_json);
    }
    public function withdraw()
    {
        $data['user'] = Auth::user();
        $data['rest'] = Auth::user();
        $data['active'] = 'profile';
        return view('newdashboard.withdraw', $data);
    }
    public function updateprofile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'phone' => ['required'],
            'school' => ['required'],

        ]);
        // dd('here');

        $user = Auth::user();
        // dd($request->all());
        if ($request->has('image')) {

            $oldImage = public_path('profilePic') . '/' . $user->image;
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path() . '/profilePic', $imageName);
            $user->image = $imageName;
        }

        $realname = ucwords(str_replace(' ', '-', $request->name));
        $user->name = $request->name;
        $user->slug = $realname;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->school = $request->school;
        $user->description = $request->description;
        // $user->opening_hour = $request->opening_hour;
        // $user->closing_hour = $request->closing_hour;

        $user->save();
        return $user;
        //update the mobile app
        $jsonData = [
            "name" => $request->name,
            "phone_number" => $request->phone,
            "email" => $user->email,
            "image" => "https://cttaste.com/cttaste_files/public/profilePic/" . $imageName
        ];

        $jsonEnc = json_encode($jsonData);
        // dd($email);

        $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/' . $user->id . '/');
        // $ch = curl_init('https://cttaste-ca8a70ea9683.herokuapp.com/api/v1/business/1242/');

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonEnc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonEnc)
        ));

        // Execute cURL session and store the response
        $response = curl_exec($ch);
        // dd($response);
        return $user;
    }
    public function updateprofile_api(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => ['required'],
                'phone' => ['required'],
                'school' => ['required'],
                'user_id' => 'required',
                // 'image' => 'required'
            ]);

            $user = User::find($request->user_id);
            if (strlen($request->image) > 5) {
                $user->image = $request->image;
            }

            $realname = ucwords(str_replace(' ', '-', $request->name));
            $user->name = $request->name;
            $user->slug = $realname;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->name = $request->name;
            $user->school = $request->school;
            $user->description = $request->description;
            // $user->opening_hour = $request->opening_hour;
            // $user->closing_hour = $request->closing_hour;

            $user->save();
            if (substr($user->image, 0, 5) !== 'https') {
                $user['image'] = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image;
            }
            $response = [
                'success' => true,
                'message' => 'Profile Updated Successfully!',
                'data' => $user
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
    public function update_password($email, $pp)
    {
        try {

            $user = User::where('email', $email)->first();
            $user->password = Hash::make($pp);
            $user->save();
            $response = [
                'success' => true,
                'message' => 'Pp Updated Successfully!',
                'data' => $user
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
    public function updateprofile_admin(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'phone' => ['required'],
            'school' => ['required'],

        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path() . '/profilePic', $imageName);
            $user->image = $imageName;
        }

        $realname = ucwords(str_replace(' ', '-', $request->name));
        $user->name = $request->name;
        $user->slug = $realname;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->school = $request->school;
        $user->description = $request->description;
       

        $user->save();
        return $user;
    }
    public function getfood()
    {

        // return '{"0":{"name":"Pepsi","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/pepsi.jfif"},"1":{"name":"Fanta","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fanta.jfif"},"2":{"name":"Coca-cola","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/coke.jfif"},"3":{"name":"7up","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/7up.jfif"},"4":{"name":"Bigi-apple","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/bigi_apple.jfif"},"5":{"name":"Maltina","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/maltina.jfif"},"6":{"name":"Five alive(puppy)","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/five_alive_puppy.jfif"},"7":{"name":"Five alive(big)","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/five_alive_big.jfif"},"8":{"name":"Origin Zero","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/origin_zero.jfif"},"9":{"name":"Fayrouz","category_id":12,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fayrouz.jfif"},"10":{"name":"Smirnoff","category_id":13,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/smirnoff.jfif"},"11":{"name":"Trophy","category_id":13,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/trophy.jfif"},"12":{"name":"Heneeky","category_id":13,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/heneeky.jfif"},"13":{"name":"Bullet","category_id":13,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/bullet.jfif"},"14":{"name":"Best Cream","category_id":13,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/best.jfif"},"15":{"name":"Fearless","category_id":14,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fearless.jfif"},"16":{"name":"Monster","category_id":14,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/monster.jfif"},"17":{"name":"Amber","category_id":14,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/amber.jfif"},"18":{"name":"Climax","category_id":14,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/climax.jfif"},"19":{"name":"Turkey","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/Turkey.jfif"},"20":{"name":"Chicken","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/Chicken.jfif"},"21":{"name":"Cat Fish","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fish.jfif"},"22":{"name":"Titus","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/titus.jfif"},"23":{"name":"Ponmo","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ponmo.jfif"},"24":{"name":"Meat","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/meat.jfif"},"25":{"name":"Egg","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/egg.jfif"},"26":{"name":"Tinko","category_id":15,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/tinko.jfif"},"27":{"name":"Fried Rice","category_id":16,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fried_rice.jfif"},"28":{"name":"Jollof Rice","category_id":16,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/jollof_rice.jfif"},"29":{"name":"White Rice","category_id":16,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/coconut_rice.jfif"},"30":{"name":"Porridge","category_id":17,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/porridge.jfif"},"31":{"name":"Eba","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/eba.jfif"},"32":{"name":"Amala","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/amala.jfif"},"33":{"name":"Semo","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/semo.jfif"},"34":{"name":"Poundo","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/poundo.jfif"},"35":{"name":"Egusi Soup","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/egusi_soup.jfif"},"36":{"name":"Ewedu Soup","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ewedu_soup.jfif"},"37":{"name":"Efo Riro Soup","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/efo_riro.jfif"},"38":{"name":"Ogbona Soup","category_id":18,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ogbona.jfif"},"39":{"name":"Salad","category_id":19,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/salad.jfif"},"40":{"name":"Moi Moi","category_id":19,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/moi_moi.jfif"},"41":{"name":"Cup Cakes","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/cup_cake.jfif"},"42":{"name":"Wedding Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/wedding_cake.jfif"},"43":{"name":"Ceremonial Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ceremonial_cake.jfif"},"44":{"name":"Chocolate Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chocolate_cake.jfif"},"45":{"name":"Vanilla Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/vanilla_cake.jfif"},"46":{"name":"Strawberry Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/strawberry_cake.jfif"},"47":{"name":"Plain Cake","category_id":20,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/plain_cake.jfif"},"48":{"name":"Cocktails","category_id":21,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/cocktails.jfif"},"49":{"name":"Mocktails","category_id":21,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/mocktails.jfif"},"50":{"name":"Meat Pie","category_id":22,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/meat_pie.jfif"},"51":{"name":"Chicken Pie","category_id":22,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_pie.jfif"},"52":{"name":"Mini Toast Bread","category_id":23,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/toast_bread.jfif"},"53":{"name":"Max Toast Bread","category_id":23,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/toast_bread.jfif"},"54":{"name":"Shawarma","category_id":24,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/shawarma.jfif"},"55":{"name":"Pizza","category_id":24,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/pizza.jfif"},"56":{"name":"Chicken Grillz","category_id":25,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_grillz.jfif"},"57":{"name":"Fish Grillz","category_id":25,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fish_grillz.jfif"},"58":{"name":"Chicken and Chips(Small)","category_id":26,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_and_chips.jfif"},"59":{"name":"Chicken and Chips(Medium)","category_id":26,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_and_chips.jfif"},"60":{"name":"Chicken and Chips(Big)","category_id":26,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_and_chips.jfif"},"61":{"name":"Chocolate Flavour Ice Cream","category_id":27,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ice_cream.jfif"},"62":{"name":"Vanilla Flavour Ice Cream","category_id":27,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ice_cream.jfif"},"63":{"name":"Strawberry Flavour Ice Cream","category_id":27,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/ice_cream.jfif"},"64":{"name":"Pap","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/pap.jfif"},"65":{"name":"Tabioka","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/cabioka.jfif"},"66":{"name":"hollandia Milk","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/hollandia.jfif"},"67":{"name":"Peak Milk","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/peak_milk.jfif"},"68":{"name":"Three Crown Milk","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/three_crown.jfif"},"69":{"name":"Akara","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/akara.jfif"},"70":{"name":"Moi-Moi","category_id":28,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/moi_moi.jfif"},"71":{"name":"Beans","category_id":29,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/bread_and_beans.jfif"},"72":{"name":"Bread","category_id":29,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/bread.jfif"},"75":{"name":"Fish Peppersoup","category_id":31,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/fish_peppersoup.jfif"},"76":{"name":"Chicken Peppersoup","category_id":31,"image":"https:\/\/cttaste.com\/cttaste_files\/public\/foodimages\/chicken_peppersoup.jfif"}}';

        // https://cttaste.com/cttaste_files/public/foodimages/fried_rice.jfif
        // 

        // $uniqueFoods = Food::orderBy('category_id')->get(['name', 'category_id', 'image'])->unique('name');
        $uniqueFoods = Food::orderBy('rank')->get(['name', 'category_id', 'image'])->unique('name')->take(200);

        $uniqueFoods->map(function ($food) {
            if (substr($food->image, 0, 5) == 'https') {
                $food->image = $food->image; // Replace 'your_prefix' with the desired string to prepend
            } else {
                $food->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $food->image; // Replace 'your_prefix' with the desired string to prepend

            }
            return $food;
        });


        return json_encode($uniqueFoods);
    }
    public function getAllMenu($id)
    {
        $food = Food::where('user_id', $id)->orderBy('rank')->get();
        $food->map(function ($food) {
            if (substr($food->image, 0, 5) == 'https') {

                $food->image = $food->image; // Replace 'your_prefix' with the desired string to prepend
            } else {

                $food->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $food->image; // Replace 'your_prefix' with the desired string to prepend

            }
            return $food;
        });

        return json_encode($food);
    }
    public function getvendors()
    {


        // $uniqueFoods = Food::orderBy('category_id')->get(['name', 'category_id', 'image'])->unique('name');
        $allusers = User::get(['id', 'name', 'email', 'password', 'phone', 'description', 'school', 'address', 'image', 'address', 'ct_charge', 'user_type', 'approve', 'rank', 'restaurant_category', 'pack_fee'])->unique('name');
        // $allusers = User::get()->unique('name');

        $restaurantCategoryMapping = [
            'food' => 1,
            'cakes' => 2,
            'shawarma' => 3,
            'others' => 4
            // Add more mappings as needed
        ];

        $allusers->map(function ($user) use ($restaurantCategoryMapping) {
            $user->image = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image; // Replace 'your_prefix' with the desired string to prepend

            // Set restaurant_category_id based on the mapping, default to 3 if not found
            $user->restaurant_category_id = $restaurantCategoryMapping[$user->restaurant_category] ?? 3;

            return $user;
        });

        return json_encode($allusers);
    }

    public function getpasswords()
    {
        $allusers = User::get(['id', 'email', 'password'])->unique('name');

        return json_encode($allusers);
    }
    public function getmenus()
    {


        // $uniqueFoods = Food::orderBy('category_id')->get(['name', 'category_id', 'image'])->unique('name');
        $foods = Food::get(['id', 'name', 'user_id', 'category_id', 'price', 'rank', 'image', 'available']);
        // $foods = User::get()->unique('name');

        $foods->map(function ($food) {
            $food->image = 'https://cttaste.com/cttaste_files/public/foodimages/' . $food->image; // Replace 'your_prefix' with the desired string to prepend
            return $food;
        });


        return json_encode($foods);
    }
    public function getlocations()
    {


        // $uniqueFoods = Food::orderBy('category_id')->get(['name', 'category_id', 'image'])->unique('name');
        $foods = DeliveryLocation::get();
        // $foods = User::get()->unique('name');



        return json_encode($foods);
    }
    public function get_vendor_location($id)
    {
        $locations = DeliveryLocation::where('user_id', $id)->get();
        $customLocation = [
            'id' => 0,
            'user_id' => $id,
            'price' => 0,
            'name' => 'Walk In (Pick it up myself)',
            // Add other fields as needed
        ];
        $others = [
            'id' => 0,
            'user_id' => $id,
            'price' => 0,
            'name' => 'Others',
            // Add other fields as needed
        ];

        // Append the custom location to the existing locations
        $locations->prepend($customLocation);
        $locations->push($others);

        return json_encode($locations);
    }
    public function create_location_api(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'user_id' => 'required'
        ]);
        DeliveryLocation::create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => $request->user_id
        ]);

        $locations = DeliveryLocation::where('user_id', $request->user_id)->get();
        $response = [
            'success' => true,
            'message' => 'Location Created Successfully!',
            'data' => $locations
        ];
        return response()->json($response);
        // return json_encode($locations);
    }
    public function delete_location_api($location_id)
    {

        $location = DeliveryLocation::find($location_id);
        $userId = $location->user_id;
        $location->delete();


        $locations = DeliveryLocation::where('user_id', $userId)->get();
        $response = [
            'success' => true,
            'message' => 'Location Deleted Successfully!',
            'data' => $locations
        ];
        return response()->json($response);
        // return json_encode($locations);
    }
    public function get_schools()
    {
        return json_encode(School::all());
    }
    public function get_all_vendors()
    {
        $current_time = now()->format('H:i:s');
        $all_current_time = now();
        $current_day = strtolower($all_current_time->format('l'));
        $restaurants = User::where('approve', 1)
            ->where('school', 1)


            ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->orderBy('opening_hour', 'asc');
            }])
            ->orderBy('rank', 'asc')
            ->get([
                'id', 'name', 'email', 'password', 'phone', 'description', 'school', 'address', 'image', 'address', 'ct_charge', 'user_type', 'approve', 'rank', 'restaurant_category', 'pack_fee',

            ]);
        $restaurants = User::where('approve', 1)
            ->where('school', 1)
            ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->orderBy('opening_hour', 'asc');
            }])
            ->orderBy('promoted', 'desc')
            ->orderBy('rank', 'asc')
            ->get([
                'id', 'name', 'email', 'password', 'phone', 'description', 'school', 'address', 'image', 'address', 'ct_charge', 'user_type', 'approve', 'rank', 'restaurant_category', 'pack_fee', 'promoted'

            ]);

        $restaurantCategoryMapping = [
            'food' => 1,
            'cakes' => 2,
            'shawarma' => 3,
            'others' => 4
            // Add more mappings as needed
        ];

        $restaurants->map(function ($user) use ($restaurantCategoryMapping, $current_time) {
            if (substr($user->image, 0, 5) == 'https') {
                $user->image = $user->image; // Replace 'your_prefix' with the desired string to prepend
            } else {
                $user->image = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image; // Replace 'your_prefix' with the desired string to prepend

            }

            // Set restaurant_category_id based on the mapping, default to 3 if not found
            $user->restaurant_category_id = $restaurantCategoryMapping[$user->restaurant_category] ?? 3;
            //map the working hours
            if ($user->working_hour->isNotEmpty()) {
                $workingHour = $user->working_hour->first();
                $openingTime = $workingHour->opening_hour;
                $closingTime = $workingHour->closing_hour;

                if ($current_time >= $openingTime && $current_time <= $closingTime) {
                    $user->is_open = true;
                } else {
                    $user->is_open = false;
                }
            } else {
                // No working hours defined, consider it closed
                $user->is_open = false;
            }
            $user->makeHidden('working_hour');

            return $user;
        });
        return json_encode($restaurants);
    }
    public function get_all_vendors_with_location($location_id)
    {
        $current_time = now()->format('H:i:s');
        $all_current_time = now();
        $current_day = strtolower($all_current_time->format('l'));
        // dd($current_time,$current_day);
        $restaurants = User::where('approve', 1)
            ->where('school', $location_id)
            ->with(['working_hour' => function ($query) use ($current_day, $current_time) {
                $query->where('day', $current_day)
                    ->orderBy('opening_hour', 'asc');
            }])
            ->orderBy('promoted', 'desc')
            ->orderBy('rank', 'asc')
            ->get([
                'id', 'name', 'email', 'password', 'phone', 'description', 'school', 'address', 'image', 'address', 'ct_charge', 'user_type', 'approve', 'rank', 'restaurant_category', 'pack_fee', 'promoted'

            ]);




        $restaurantCategoryMapping = [
            'food' => 1,
            'cakes' => 2,
            'shawarma' => 3,
            'others' => 4
            // Add more mappings as needed
        ];

        $restaurants->map(function ($user) use ($restaurantCategoryMapping, $current_time) {
            if (substr($user->image, 0, 5) == 'https') {
                $user->image = $user->image; // Replace 'your_prefix' with the desired string to prepend
            } else {
                $user->image = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image; // Replace 'your_prefix' with the desired string to prepend

            }

            // Set restaurant_category_id based on the mapping, default to 3 if not found
            $user->restaurant_category_id = $restaurantCategoryMapping[$user->restaurant_category] ?? 3;
            //map the working hours
            if ($user->working_hour->isNotEmpty()) {
                $workingHour = $user->working_hour->first();
                $openingTime = $workingHour->opening_hour;
                $closingTime = $workingHour->closing_hour;
                $available = $workingHour->availability;

                if ($current_time >= $openingTime && $current_time <= $closingTime && $available == 1) {
                    $user->is_open = true;
                } else {
                    $user->is_open = false;
                }
            } else {
                // No working hours defined, consider it closed
                $user->is_open = false;
            }
            $user->makeHidden('working_hour');

            return $user;
        });
        return json_encode($restaurants);
    }
    public function update_balance($user_id, $amount, Request $request)
    {
        try {
            $this->validate($request, [
                ''
            ]);

            $user = User::find($user_id);
            $tranx =  Transaction::create([
                'rest_id' => $user_id,
                'order_id' => $request->order_id ?? null,
                'amount' => $amount,
                'before_balance' => $user->balance,
                'reference' => $request->reference ?? Str::random(8),
                'type' => $request->type,
                'title' => $request->title,
                'details' => $request->datails . "Amount :" . $amount . " Name : " . $request->customer_name . " , Phone : " . $request->customer_phone,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'status' => 1
            ]);
            $user->balance += $amount;
            $user->save();
            $tranx->after_balance = $user->balance;
            $tranx->save();
            //save transaction


            $transactions = Transaction::where('rest_id', $user_id)->latest()->get();
            if (substr($user->image, 0, 5) !== 'https') {
                $user['image'] = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image;
            }
            $response = [
                'success' => true,
                'message' => 'Balance Updated Successfully!',
                'data' => $user,
                'transactions' => $transactions
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
    public function fetch_balance($user_id)
    {
        try {

            $user = User::find($user_id);


            if (substr($user->image, 0, 5) !== 'https') {
                $user['image'] = 'https://cttaste.com/cttaste_files/public/profilePic/' . $user->image;
            }
            $response = [
                'success' => true,
                'message' => 'Balance Updated Successfully!',
                'data' => $user
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
    public function fetch_transactions($user_id)
    {
        try {

            $transactions = Transaction::where('rest_id', $user_id)->latest()->get();
            $response = [
                'success' => true,
                'message' => 'Balance Updated Successfully!',
                'data' => $transactions
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

    //the referral code here 

 
}
