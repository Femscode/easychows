<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Category;
use App\Models\Discount;
use App\Models\FoodImage;
use App\Models\Transaction;
use App\Models\WorkingHour;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DiscountedUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Controller
{
    //function for the super admin
    public function index()
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['users'] = $users = User::latest()->get();
            $data['active'] = 'this';
            $data['admins'] = User::where('user_type', 'admin')->latest()->get();
            return view('dashboard.admin', $data);
            return view('superadmin.index', $data);
        } else {
            return redirect()->back();
        }
    }
   
  
    
    public function block_user($id)
    {
        $user = User::find($id);
        if ($user->block == 1) {
            $user->block = 0;
        } else {
            $user->block = 1;
        }

        $user->save();
        return redirect()->back()->with('message', "User blocked successfully!");
    }
   
   
    public function admin_today()
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {

            $data['orders'] = Order::whereDate('created_at', today())->latest()->get();
            $data['active'] = 'this';
            $data['users'] = User::orderBy('rank')->get();
            return view('superadmin.admin_today', $data);
        } else {
            return redirect()->back();
        }
    }
    public function admin_yesterday()
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {

            $data['orders'] = Order::whereDate('created_at', now()->subDay())->latest()->get();
            $data['active'] = 'this';
            $data['users'] = User::orderBy('rank')->get();


            return view('superadmin.admin_yesterday', $data);
        } else {
            return redirect()->back();
        }
    }
    public function cashout()
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['users'] = User::with('orders')->orderBy('rank')->get();
            $data['orders'] = Order::where('created_at', '>=', now()->startOfWeek(Carbon::SUNDAY))->latest()->count();

            return view('superadmin.cashout', $data);
        } else {
            return redirect()->back();
        }
    }

    public function contact_gain()
    {
        $data['user'] = $user =  Auth::user();
        if ($user->email !== 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            return redirect()->route('dashboard');
        }
        $data['active'] = 'super';

        return view('superadmin.contact_gain', $data);
    }
    public function downloadCSV(Request $request)
    {
        // dd($request->all());
        // $users = User::where('created_at', '>', $request->from)->where('created_at', '<', $request->to)->get(['name', 'phone']);
        $orders = Order::from('orders as o')->select('o.name', 'o.phone')
            ->join(DB::raw('(SELECT phone, MIN(created_at) AS min_created_at
                        FROM orders
                        WHERE created_at >= "' . $request->from . '" AND created_at <= "' . $request->to . '"
                        AND LENGTH(phone) IN (10, 11, 13, 14)
                        GROUP BY phone) AS min_dates'), function ($join) {
                $join->on('o.phone', '=', 'min_dates.phone')
                    ->on('o.created_at', '=', 'min_dates.min_created_at');
            })
            ->get();

        $filename = Carbon::now()->format('d-m-Y') . '_cttaste_users_data.csv';


        return response()->stream(
            function () use ($orders, $request) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Name', 'Phone']);

                foreach ($orders as $order) {
                    // Append the name with the prefix from $request->prefix
                    $nameWithPrefix = $request->prefix . ' ' . $order->name;

                    fputcsv($handle, [$nameWithPrefix, $order->phone]);
                }

                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
    // static function get_weekly_sales($id)
    // {
    //     $data['orders'] = $or = Order::where('user_id', $id)->where('created_at', '>=', now()->startOfWeek())->latest()->get();
    //     return Count($or);
    // }

    public function check_today_vendor(Request $request)
    {
        // dd($request->all());
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            if ($request->time == 'today') {
                $data['orders'] = Order::whereDate('created_at', today())->where('user_id', $request->vendor)->latest()->get();
            } else {
                $data['orders'] = Order::whereDate('created_at',  now()->subDay())->where('user_id', $request->vendor)->latest()->get();
            }
            $data['active'] = 'this';
            $data['users'] = User::orderBy('rank')->get();
            return view('superadmin.admin_today', $data);
        } else {
            return redirect()->back();
        }
    }
    public function vendor_order($id)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['user'] = $user = User::find($id);
            $data['orders'] = Order::where('user_id', $user->id)->latest()->paginate(50);
            $data['mycount'] = Count(Order::where('user_id', $user->id)->latest()->get());
            $data['active'] = 'this';
            return view('superadmin.managerorder', $data);
        } else {
            return redirect()->back();
        }
    }
    public function discount()
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {

            $data['active'] = 'this';
            $data['discount'] = Discount::find(1);
            $data['admins'] = User::where('user_type', 'admin')->latest()->get();
            $data['users'] = $users = DiscountedUser::latest()->get();

            return view('superadmin.discount', $data);
        } else {
            return redirect()->back();
        }
    }
    public function update_discount_unit(Request $request)
    {

        $discount = Discount::find(1);
        $discount->promo = $request->discount;
        if ($request->has('sponsor')) {
            $discount->sponsor = $request->sponsor;
        }
        $discount->save();
        return redirect()->back()->with('message', 'Discounted price updated successfully');
    }
    public function userprofile($id)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['user'] = User::find($id);
            $data['active'] = 'this';
            return view('superadmin.users', $data);
        } else {
            return redirect()->back();
        }
    }
    public function userfood($id)
    {

        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['user'] = Auth::user();
            $data['vendor'] = $user = User::find($id);
            $data['categories'] = Category::where('user_id', $user->id)->get();
            $data['foods'] = Food::where('user_id', $user->id)->get();
            $data['active'] = 'this';
            $data['foodimages'] = FoodImage::latest()->get();
            return view('superadmin.userfood', $data);
        } else {
            return redirect()->back();
        }
    }
    public function superworking_hours($id)
    {

        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['user'] = Auth::user();
            $data['vendor'] = $user = User::find($id);
            $data['working_hours'] = $wk = WorkingHour::where('vendor_id', $user->id)->get();


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
            $data['active'] = 'profile';
            $data['working_hours'] = $wk = WorkingHour::where('vendor_id', $user->id)->get();

            return view('superadmin.super_working_hours', $data);
        } else {
            return redirect()->back();
        }
    }
    public function checkreview($id)
    {
        $data['user'] = $user = User::find($id);
        $data['reviews'] = Review::where('rest_id', $user->id)->latest()->paginate(10);
        $data['active'] = 'reviews';
        return view('backend.reviews', $data);
        return view('newdashboard.reviews', $data);
    }
    public function userorder($id)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $data['user'] = $user = User::find($id);
            $data['orders'] = Order::where('user_id', $user->id)->latest()->paginate(50);
            $data['mycount'] = Count(Order::where('user_id', $user->id)->latest()->get());
            $data['active'] = 'this';
            return view('superadmin.userorder', $data);
        } else {
            return redirect()->back();
        }
    }
    public function update_bonus(Request $request)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $user = User::find($request->user_id);
            $user->bonus = $request->bonus;
            $user->save();
            return redirect()->back()->with('message', 'Bonus updated successfully');
        } else {
            return redirect()->back();
        }
    }
    public function update_rank(Request $request)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
            $user = User::find($request->user_id);
            $user->rank = $request->rank;
            $user->save();
            return redirect()->back()->with('message', 'Rank updated successfully');
        } else {
            return redirect()->back();
        }
    }

    public function disable($id)
    {
        $user_email = Auth::user();
        $r_user = User::find($id);


        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com' || $user_email->email == $r_user->email) {

            $data['user'] = $user = User::find($id);
            // dd($user);

            if ($user->availability == 1) {
                // dd('here',$user);
                $user->opening_hour = '9:00';
                $user->closing_hour = '9:00';
                $working_hours = WorkingHour::where('vendor_id', $id)->update(['availability' => 0]);
                $user->availability = 0;
                $user->save();
                return redirect()->back()->with('message', 'Account Closed successfully');
            } else {
                $user->opening_hour = '9:00';
                $user->closing_hour = '21:00';
                $user->availability = 1;
                $working_hours = WorkingHour::where('vendor_id', $id)->update(['availability' => 1]);
                $user->save();

                return redirect()->back()->with('message', 'Account Opened successfully');
            }
        } else {
            return redirect()->back();
        }
    }

    public function approveuser($id)
    {
        $user = User::find($id);
       
            if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
                $user->approve = 1;
                $user->save();
                return redirect()->back()->with('message', 'User has been approved successfully!');
            } else {
                return redirect()->back()->with('message', 'Access Denied!');
               
            }
    }

    public function disapproveuser($id)
    {
        $user = User::find($id);
       
            if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {
                $user->approve = 0;
                $user->save();
                //   dd($user);
                return redirect()->back()->with('message', 'User has been disapproved successfully!');
            } else {
                return redirect()->back()->with('message', 'Access Denied!');
                
            }
       
     
    }
   
    public function deleteuser($id)
    {
        if (Auth::user()->email == 'fasanyafemi@gmail.com' || Auth::user()->email == 'odekomayatosin@yahoo.com') {

            $user = User::find($id);
            $food = Food::where('user_id', $user->id)->delete();
            $categories = Category::where('user_id', $user->id)->delete();
            $user->delete();
            return redirect()->back()->with('message', 'User deleted successfully');
        } else {
            return redirect()->back();
        }
    }
}
