<?php

namespace App\Http\Controllers;

use DateTime;
use \Carbon\Carbon;
use App\Models\Cart;
use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\AppUser;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DiscountedUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function records()
    {
        $data['user'] = $user =Auth::user();
      
        $data['orders'] = $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
        // $data['orders'] = $orders = DB::table('oldorders')->where('user_id', Auth::user()->id)->latest()->get();
        // $data['foods'] = $pro = Food::where('user_id', Auth::user()->id)->get();
        // FOR LAST YEAR SORTING
        //ENd of last yeAR
        $products = [];
        $tt = 0;
        //this will get all the products in one array stored in product variable
        foreach ($orders as $order) {
            $tt += $order->total_price;
            $pro1 =  unserialize($order->cart);

            if (is_object($pro1) && property_exists($pro1, 'items')) {
                foreach ($pro1->items as $pro) {
                    array_push($products, $pro);
                }
            }
        }
        //the tt contains the total sum of all orders
        $data['total_sales'] = $tt;
        $foods = [];
        $data['food'] = $food = collect($products)->groupBy('name');
        //this will sum the quatity of a particular product and put it inside an array, ff->first for taking just one of each product
        foreach ($food as $ff) {
            $k = $ff->sum('qty');
            array_push($foods, [$ff->first(), $k]);
        }
        //this performs the sorting by using sortBy and reverse.
        $foodie = collect($foods)->sortBy(1)->reverse();

        $data['foods'] = $foodie;
        $data['active'] = 'records';

        return view('newdashboard.record', $data);
        return view('backend.record', $data);
    }



    public function checkreviews()
    {
        $data['user'] = $user = Auth::user();
        $data['reviews'] = Review::where('rest_id', $user->id)->latest()->paginate(10);
        $data['active'] = 'reviews';
        return view('newdashboard.reviews', $data);
        return view('backend.reviews', $data);
    }
   


    public function checkout(Request $request, $fee)
    {
       
        //handle_referral_first
       


        $this->validate($request, ['delivery_amount' => 'required']);

        $delivery_amount = $request->delivery_amount;

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        $data['carts'] = $cart;

        if ($cart) {
            $restaurantId = $cart->restaurant;

            // Find the user once outside the loop to reduce database queries
            $user = User::find($restaurantId);

            $pack = [];

            for ($i = 0; $i < 10; $i++) {
                $pack[$i] = [];

                foreach ($cart->items as $item) {
                    if (in_array($i, $item['plate'])) {
                        $f_u = Food::find($item['id']);
                        $f_u->quantity -= $item['qty'];
                        $f_u->save();

                        $tmp = array_count_values($item['plate']);
                        $cnt = $tmp[$i];

                        $item['qty'] = $cnt;
                        unset($item['plate']);
                        unset($item['id']);
                        unset($item['price']);
                        unset($item['image']);
                        array_push($pack[$i], $item);
                    }
                }
            }

            $agba = [];

            for ($j = 1; $j <= 15; $j++) {
                if (session()->has('pack[' . $j . ']')) {
                    $data['pack' . $j] = $pack[$j];
                    $agba['pack' . $j] = $pack[$j];
                }
            }

            $firi = json_encode($agba);
        } else {
            $user = null;
        }

        // dd($firi);
        $therest = str_replace(['{', '::', 'id', '"', '[', ']', 'name:', ',', ':'], '', $firi);
        $therest2 = str_replace('}', '%0a', $therest);

        for ($i = 1; $i <= 10; $i++) {
            $packNumber = 'pack' . $i;
            $replacement = 'PACK' . $i . '%0a--�--%0a';
            $therest2 = str_replace($packNumber, $replacement, $therest2);
        }

        $packs = str_replace('qty', ' | qty:', $therest2);
        // Create the order
        $orderData = [
            'user_id' => $cart->restaurant,
            'order_id' => $request->order_id . Str::random(5),
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
            'quantity' => $cart->totalQty,
            'delivery_amount' => $delivery_amount,
            'total_price' => $cart->totalPrice + intval($fee) + intval($delivery_amount),
            'cart' => serialize(session()->get('cart')),
            'session' => serialize(session()->all()),
        ];

        $order = Order::create($orderData);

        // Calculate prices based on user ID
        $extraFee = ($user->id == 53 || $user->id == 38) ? 50 : 0;
        $f_price = $cart->totalPrice + intval($fee) + intval($delivery_amount) + $extraFee;
        $d_price = intval($request->delivery_amount);
        $s_price = $cart->totalPrice + intval($fee) + $extraFee;


     

        $whatsappMessage = "*ORDER%20%20FROM%20EASYCHOWS*%20%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20EC-" . $order->order_id . "%0a--�--%0a" . $packs . "*SUB%20TOTAL%20:%20₦" . $s_price . "*%0a*DELIVERY%20PRICE%20:%20₦" . $d_price . "*%0a*TOTAL%20PRICE%20:%20₦" . $f_price . "*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20" . $request->name . "%0aLocation%20:%20" . $request->location . "%0aAddress%20:%20" . $request->address . "%0aPhone%20number%20:%20" . $request->phone . "%0a*---PRICE%20CONFIRMATION*---%0ahttps://cttaste.com/price/" . $user->id . "/" . $order->order_id;
        // dd($whatsappMessage);
     
           
        return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=' . $whatsappMessage);
    }

    public function previous_checkout(Request $request, $fee)
    {
        // dd($request->all());

        $this->validate($request, ['delivery_amount' => 'required']);
        $delivery_amount = $request->delivery_amount;
        //    dd('here');
        if (session()->has('cart')) {
            $data['carts'] =  $cart = new Cart(session()->get('cart'));
        } else {
            $data['carts'] = $cart = null;
        }
        $user = User::find($cart->restaurant);
        for ($i = 0; $i < 10; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {
                if (in_array($i, $item['plate'])) {
                    $f_u = Food::find($item['id']);
                    $f_u->quantity -= $item['qty'];
                    $f_u->save();
                    $tmp = array_count_values($item['plate']);
                    $cnt = $tmp[$i];

                    $item['qty'] = $cnt;
                    unset($item['plate']);
                    unset($item['id']);
                    unset($item['price']);
                    unset($item['image']);
                    array_push($pack[$i], $item);
                }
            }
        }

        $agba = [];
        for ($j = 1; $j <= 15; $j++) {
            if (session()->has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                array_push($agba, ['pack' . $j . '' => $pack[$j]]);
            }
        }

        $firi = json_encode($agba);

        $therest = str_replace(['{', '::', 'id', '"', 'pack0', '[', ']', 'name:', ',', ':'], '', $firi);
        // $therest2 = str_replace('}', '%0a--�--%0a', $therest);
        $therest2 = str_replace('}', '%0a', $therest);
        $pack1 = str_replace('pack1', 'PACK1%0a--�--%0a', $therest2);
        $pack2 = str_replace('pack2', 'PACK2%0a--�--%0a', $pack1);
        $pack3 = str_replace('pack3', 'PACK3%0a--�--%0a', $pack2);
        $pack4 = str_replace('pack4', 'PACK4%0a--�--%0a', $pack3);
        $pack5 = str_replace('pack5', 'PACK5%0a--�--%0a', $pack4);
        $pack6 = str_replace('pack6', 'PACK6%0a--�--%0a', $pack5);
        $pack7 = str_replace('pack7', 'PACK7%0a--�--%0a', $pack6);
        $pack8 = str_replace('pack8', 'PACK8%0a--�--%0a', $pack7);
        $pack9 = str_replace('pack9', 'PACK9%0a--�--%0a', $pack8);
        $pack10 = str_replace('pack10', 'PACK10%0a--�--%0a', $pack9);

        $packs = str_replace('qty', ' | qty:', $pack9);



        $order = Order::create([
            'user_id' => $cart->restaurant,
            'order_id' => $request->order_id . Str::random(5),
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
            'name' => $request->name,
            'quantity' => $cart->totalQty,
            'delivery_amount' => $delivery_amount,
            'total_price' => $cart->totalPrice + intval($fee) + intval($delivery_amount),
            'cart' => serialize(session()->get('cart')),
            'session' => serialize(session()->all()),
        ]);
        if ($user->id == 53 || $user->id == 38) {
            $f_price = $cart->totalPrice + intval($fee) + intval($delivery_amount) + 50;
            $d_price = intval($request->delivery_amount);
            $s_price = $cart->totalPrice + intval($fee) + 50;
        } else {
            $f_price = $cart->totalPrice + intval($fee) + intval($delivery_amount);
            $d_price = intval($request->delivery_amount);
            $s_price = $cart->totalPrice + intval($fee);
        }

        // for sending via mail and sms
        // $mailpack =  str_replace('%0a', "<br>", $packs);
        // $mail_message = 'ORDER DETAILS<br>' . $mailpack . '<br>SUB TOTAL→₦' . $s_price. '<br>DELIVERY PRICE→₦' . $d_price. '<br>TOTAL PRICE→₦' . $f_price. '<br>------CUSTOMER DETAILS------<br>Name→' . $request->name . '<br>Location→' . $request->location . '<br>Address→' . $request->address . '<br>Phone number→' . $request->phone;

        // $data = array('order_details'=>$mail_message, 'phone' => $request->phone, 'slug'=>ucwords(str_replace(' ','',$request->name)));
        // Mail::send('mail.order', $data, function($message) use($user) {
        //     $message->to($user->email, '')->subject
        //       ('Order From CTtaste');
        //     $message->from('support@cttaste.com','CTtaste');
        //  });
        // return redirect()->away('sms:' . $user->phone. '?body=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0a--�--%0a'.$packs.'*SUB%20TOTAL→₦' . $s_price. '*%0a*DELIVERY%20PRICE→₦' . $d_price. '*%0a*TOTAL%20PRICE→₦' . $f_price. '*%0a------*CUSTOMER%20DETAILS*------%0aName→' . $request->name . '%0aLocation→' . $request->location . '%0aAddress→' . $request->address . '%0aPhone%20number→' . $request->phone . '%20');
        //endmail send
        //for sending discount, please note that you'll have to set the count from the database first before decrementing
        if (isset($_POST['payonline'])) {

            return redirect()->away('https://fastpay.cttaste.com/' . $order->order_id);
        }
        if ($request->discount == 'true') {
            DiscountedUser::create([
                'restaurant_id' => $cart->restaurant,
                'name' => $request->name,
                'phone' => $request->phone,
                'location' => $request->location,
                'amount' => $delivery_amount,
                'cart' => serialize(session()->get('cart')),
            ]);

            return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20FREE*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*PRICE%20CONFIRMATION*------%0ahttps://cttaste.com/price/" . $user->id . "/" . $order->order_id);
        } else {
            //   without price confirmation
            //    return redirect()->away('https://wa.me/234' . substr($user->phone,1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20'.$request->order_id.'%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price. '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price. '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price. '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20');
            // For price confirmation
            return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price . '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*MAKE%20PAYMENT*------%0ahttps://fastpay.cttaste.com/" . $order->order_id);
            if ($user->delivery_status == 1) {
                return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price . '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*TRACK%20ORDER*------%0ahttps://cttaste.com/track_order/" . $order->order_id);
            } else {
                return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price . '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*PRICE%20CONFIRMATION*------%0ahttps://cttaste.com/price/" . $user->id . "/" . $order->order_id);
            }
        }
    }
    public function checkout_load_order(Request $request)
    {


        $this->validate($request, ['delivery_amount' => 'required']);
        $fee = $request->fee;
        $delivery_amount = $request->delivery_amount;
        //    dd('here');
        if (session()->has('cart')) {
            $data['carts'] =  $cart = new Cart(session()->get('cart'));
        } else {
            $data['carts'] = $cart = null;
        }
        $user = User::find($cart->restaurant);

        for ($i = 0; $i < 10; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {
                if (in_array($i, $item['plate'])) {
                    $f_u = Food::find($item['id']);
                    if ($f_u->available == 0) {
                        // $cart->totalPrice -= $item['price'];
                        unset($item);
                    } else {
                        $f_u->quantity -= $item['qty'];
                        $f_u->save();
                        $tmp = array_count_values($item['plate']);
                        $cnt = $tmp[$i];

                        $item['qty'] = $cnt;
                        unset($item['plate']);
                        unset($item['id']);
                        unset($item['price']);
                        unset($item['image']);
                        array_push($pack[$i], $item);
                    }
                }
            }
        }

        $agba = [];
        for ($j = 1; $j <= 15; $j++) {
            if (session()->has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                array_push($agba, ['pack' . $j . '' => $pack[$j]]);
            }
        }

        $firi = json_encode($agba);
        $therest = str_replace(['{', '::', 'id', '"', 'pack0', '[', ']', 'name:', ',', ':'], '', $firi);
        // $therest2 = str_replace('}', '%0a--�--%0a', $therest);
        $therest2 = str_replace('}', '%0a', $therest);
        $pack1 = str_replace('pack1', 'PACK1%0a--�--%0a', $therest2);
        $pack2 = str_replace('pack2', 'PACK2%0a--�--%0a', $pack1);
        $pack3 = str_replace('pack3', 'PACK3%0a--�--%0a', $pack2);
        $pack4 = str_replace('pack4', 'PACK4%0a--�--%0a', $pack3);
        $pack5 = str_replace('pack5', 'PACK5%0a--�--%0a', $pack4);
        $pack6 = str_replace('pack6', 'PACK6%0a--�--%0a', $pack5);
        $pack7 = str_replace('pack7', 'PACK7%0a--�--%0a', $pack6);
        $pack8 = str_replace('pack8', 'PACK8%0a--�--%0a', $pack7);
        $pack9 = str_replace('pack9', 'PACK9%0a--�--%0a', $pack8);
        $pack10 = str_replace('pack10', 'PACK10%0a--�--%0a', $pack9);

        $packs = str_replace('qty', ' | qty:', $pack9);



        $order = Order::create([
            'user_id' => $cart->restaurant,
            'order_id' => $request->order_id . Str::random(5),
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
            'name' => $request->name,
            'quantity' => $cart->totalQty,
            'delivery_amount' => $delivery_amount,
            'total_price' => $cart->totalPrice + intval($fee) + intval($delivery_amount),
            'cart' => serialize(session()->get('cart')),
            'session' => serialize(session()->all()),
        ]);
        if ($user->id == 53 || $user->id == 38) {
            $f_price = $cart->totalPrice + intval($fee) + intval($delivery_amount) + 50;
            $d_price = intval($request->delivery_amount);
            $s_price = $cart->totalPrice + intval($fee) + 50;
        } else {
            $f_price = $cart->totalPrice + intval($fee) + intval($delivery_amount);
            $d_price = intval($request->delivery_amount);
            $s_price = $cart->totalPrice + intval($fee);
        }


        if ($request->discount == 'true') {
            DiscountedUser::create([
                'restaurant_id' => $cart->restaurant,
                'name' => $request->name,
                'phone' => $request->phone,
                'location' => $request->location,
                'amount' => $delivery_amount,
                'cart' => serialize(session()->get('cart')),
            ]);

            return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20FREE*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*PRICE%20CONFIRMATION*------%0ahttps://cttaste.com/price/" . $user->id . "/" . $order->order_id);
        } else {
            //   without price confirmation
            //    return redirect()->away('https://wa.me/234' . substr($user->phone,1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20'.$request->order_id.'%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price. '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price. '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price. '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20');
            // For price confirmation
            return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price . '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*MAKE%20PAYMENT*------%0ahttps://fastpay.cttaste.com/" . $order->order_id);
        }
    }
    public function processOrder(Request $request)
    {

        if (session()->has('cart')) {
            $data['carts'] =  $cart = new Cart(session()->get('cart'));
        } else {
            $data['carts'] = $cart = null;
        }

        $order = Order::where('order_id', $request->order_id)->first();
        $cart = unserialize($order->cart);
        $sessionData = unserialize($order->session);

        session()->flush();

        // Set the retrieved session data in the current session
        session()->put($sessionData);

        $user = User::find($order->user_id);

        for ($i = 0; $i < 15; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {
                if (in_array($i, $item['plate'])) {
                    $f_u = Food::find($item['id']);
                    $f_u->quantity -= $item['qty'];
                    $f_u->save();
                    $tmp = array_count_values($item['plate']);
                    $cnt = $tmp[$i];

                    $item['qty'] = $cnt;
                    unset($item['plate']);
                    unset($item['id']);
                    unset($item['price']);
                    unset($item['image']);
                    array_push($pack[$i], $item);
                }
            }
        }

        $agba = [];
        for ($j = 1; $j <= 15; $j++) {
            if (session()->has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                array_push($agba, ['pack' . $j . '' => $pack[$j]]);
            }
        }

        $firi = json_encode($agba);
        $therest = str_replace(['{', '::', 'id', '"', 'pack0', '[', ']', 'name:', ',', ':'], '', $firi);
        // $therest2 = str_replace('}', '%0a--�--%0a', $therest);
        $therest2 = str_replace('}', '%0a', $therest);
        $pack1 = str_replace('pack1', 'PACK1%0a--�--%0a', $therest2);
        $pack2 = str_replace('pack2', 'PACK2%0a--�--%0a', $pack1);
        $pack3 = str_replace('pack3', 'PACK3%0a--�--%0a', $pack2);
        $pack4 = str_replace('pack4', 'PACK4%0a--�--%0a', $pack3);
        $pack5 = str_replace('pack5', 'PACK5%0a--�--%0a', $pack4);
        $pack6 = str_replace('pack6', 'PACK6%0a--�--%0a', $pack5);
        $pack7 = str_replace('pack7', 'PACK7%0a--�--%0a', $pack6);
        $pack8 = str_replace('pack8', 'PACK8%0a--�--%0a', $pack7);
        $pack9 = str_replace('pack9', 'PACK9%0a--�--%0a', $pack8);
        $pack10 = str_replace('pack10', 'PACK10%0a--�--%0a', $pack9);

        $packs = str_replace('qty', ' | qty:', $pack9);


        $delivery_amount = $order->delivery_amount;


        $response = 'https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $order->total_price - $order->delivery_amount . '*%0a*DELIVERY%20PRICE%20:%20₦' . $order->delivery_amount . '*%0a*TOTAL%20PRICE%20:%20₦' .  $order->total_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $order->name . '%0aLocation%20:%20' . $order->location . '%0aAddress%20:%20' . $order->address . '%0aPhone%20number%20:%20' . $order->phone . '%20' . "*%0a------*MAKE%20PAYMENT*------%0ahttps://fastpay.cttaste.com/" . $order->order_id;
        // return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $order->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $order->delivery_amount . '*%0a*TOTAL%20PRICE%20:%20₦' .  $order->total_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*MAKE%20PAYMENT*------%0ahttps://fastpay.cttaste.com/" . $order->order_id);
        $response = [
            'success' => true,
            'message' => $response,
        ];

        return response()->json($response);
    }
    public function getOrderDetails(Request $request)
    {
        try {
            // if ($request->bearerToken() == 'eyJhbPciOiJIUzI7NiIsInT5cCI6IkpXVCJ4') {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'order_id' => 'required',
                'name' => 'required',
                // 'phone_number' => 'required',
                'address' => 'required',
                'grand_total' => 'required',
                'order_detail' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid input data',
                    'errors' => $validator->errors(),
                ], 400);
            }
            if ($request->has('referral_code')) {
                $appuser = AppUser::where('hod_referral_code', $request->referral_code)->first();

                if ($appuser !== null) {


                    if (!in_array($request->phone_number, $appuser->phone_numbers)) {
                        $appuser->referral_count += 1;
                        $existingNumbers = $appuser->phone_numbers;
                        $existingNumbers[] = $request->phone_number;
                        $appuser->phone_numbers = $existingNumbers;
                        $appuser->save();
                    }
                }
            }

            $order = Order::create([
                'user_id' => $request->user_id,
                'order_id' => $request->order_id,
                'name' => $request->name,
                'phone' => $request->phone_number,
                'location' => $request->location,
                'address' => $request->address,
                'total_price' => $request->grand_total,
                'mode' => 'app',
                'cart' => serialize($request->order_detail),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Order Saved Successfully',
                'data' => $order
            ], 200);
            // } else {
            //     return response()->json([
            //         'status' => true,
            //         'message' => 'Invalid Token, Unauthenticated',
            //     ], 401);
            // }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }






    public function checkout_api(Request $request, $fee)
    {




        if (session()->has('cart')) {
            $data['carts'] =  $cart = new Cart(session()->get('cart'));
        } else {
            $data['carts'] = $cart = null;
        }
        // dd($cart->items);
        $user = User::find($cart->restaurant);
        $rest_name = $user->name;

        $admin = User::where('name', $user->assigned)->first();
        for ($i = 0; $i < 15; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {
                if (in_array($i, $item['plate'])) {
                    $f_u = Food::find($item['id']);
                    $f_u->quantity -= $item['qty'];
                    $f_u->save();
                    $tmp = array_count_values($item['plate']);
                    $cnt = $tmp[$i];

                    $item['qty'] = $cnt;
                    unset($item['plate']);
                    unset($item['id']);
                    unset($item['price']);
                    unset($item['image']);
                    array_push($pack[$i], $item);
                }
            }
        }

        $agba = [];
        for ($j = 1; $j <= 15; $j++) {
            if (session()->has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                array_push($agba, ['pack' . $j . '' => $pack[$j]]);
            }
        }

        $firi = json_encode($agba);
        $therest = str_replace(['{', '::', 'id', '"', 'pack0', '[', ']', 'name:', ',', ':'], '', $firi);
        // $therest2 = str_replace('}', '%0a--�--%0a', $therest);
        $therest2 = str_replace('}', '%0a', $therest);
        $pack1 = str_replace('pack1', 'PACK1%0a--�--%0a', $therest2);
        $pack2 = str_replace('pack2', 'PACK2%0a--�--%0a', $pack1);
        $pack3 = str_replace('pack3', 'PACK3%0a--�--%0a', $pack2);
        $pack4 = str_replace('pack4', 'PACK4%0a--�--%0a', $pack3);
        $pack5 = str_replace('pack5', 'PACK5%0a--�--%0a', $pack4);
        $pack6 = str_replace('pack6', 'PACK6%0a--�--%0a', $pack5);
        $pack7 = str_replace('pack7', 'PACK7%0a--�--%0a', $pack6);
        $pack8 = str_replace('pack8', 'PACK8%0a--�--%0a', $pack7);
        $pack9 = str_replace('pack9', 'PACK9%0a--�--%0a', $pack8);
        $pack10 = str_replace('pack10', 'PACK10%0a--�--%0a', $pack9);

        $packs = str_replace('qty', ' | qty:', $pack9);

        // dd($packs,json_encode($data['pack1']), $data,session()->all());

        // dd($admin);

        // $number = substr($admin->phone,1);


        Order::create([
            'user_id' => $cart->restaurant,
            'order_id' => substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 4),
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
            'name' => $request->name,
            'quantity' => $cart->totalQty,

            'total_price' => $cart->totalPrice + intval($fee),
            'cart' => serialize(session()->get('cart')),
        ]);
        $f_price = $cart->totalPrice + intval($fee);
        $d_price = intval($fee);

        $s_price = $cart->totalPrice;

        return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20' . $rest_name . '*%20%0a%0a*ORDER%20DETAILS*%0aOrder%20ID%20:%20' . $request->order_id . '%0a--�--%0a' . $packs . '*SUB%20TOTAL%20:%20₦' . $s_price . '*%0a*DELIVERY%20PRICE%20:%20₦' . $d_price . '*%0a*TOTAL%20PRICE%20:%20₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName%20:%20' . $request->name . '%0aLocation%20:%20' . $request->location . '%0aAddress%20:%20' . $request->address . '%0aPhone%20number%20:%20' . $request->phone . '%20' . "*%0a------*PRICE%20CONFIRMATION*------%0ahttps://cttaste.com/price/" . $user->id . "/" . $request->order_id);


        // return redirect()->away('https://wa.me/234'.$number.'?text=Hi%2C%20my%20name%20is%20%28Input%20your%20name%29.%0aHOSTEL%20REQUEST%20FOR%20CTHOSTEL.%0aInstitution:'.$album->school->name.'%0aHostel%20name:%20('.$album->name.')%0aHostel%20Price:'.$album->price.'%0aLocation:'.$album->category->name.'%0aAgent%20in%20charge:'.$album->user->name.'%0a(Input%20other%20message%20here)%20');
        return redirect()->away('https://wa.me/234' . substr($user->phone, 1) . '?text=*ORDER%20%20FROM%20CTTASTE*%20%0a%0a*ORDER%20DETAILS*%0a--�--%0aRestaurant%20name:%20*' . $rest_name . '*%0a' . $packs . '%0a*SUB%20TOTAL→₦' . $s_price . '*%0a*PACK%20FEE→₦' . $d_price . '*%0a*TOTAL%20PRICE→₦' . $f_price . '*%0a------*CUSTOMER%20DETAILS*------%0aName→' . $request->name . '%0aLocation→' . $request->location . '%0aAddress→' . $request->address . '%0aPhone%20number→' . $request->phone . '%0a(Input%20other%20message%20here)%20');
    }

    public function userorder()
    {
        $data['user'] = $user = Auth::user();
        $data['orders'] = $order = Order::where('user_id', $user->id)->latest()->get();
        // $data['orders'] = $order = DB::table('oldorders')->where('user_id', $user->id)->latest()->get();
        // dd(unserialize($order[0]->cart));
        $data['active'] = 'orders';

        return view('dashboard.orders', $data);
        return view('newdashboard.order', $data);
    }
    public function today_orders()
    {
        $data['user'] = $user = Auth::user();
        $data['orders'] = Order::where('user_id', $user->id)->whereBetween('created_at', [Carbon::today(), Carbon::today()->addDay()])->latest()->get();
        // dd(unserialize($order[0]->cart));
        $data['active'] = 'orders';

        return view('newdashboard.today_order', $data);
    }
    public function transactions()
    {
        $data['user'] = $user = Auth::user();
        $data['transactions'] = Transaction::where('rest_id', $user->id)->latest()->get();
        // dd(unserialize($order[0]->cart));
        $data['active'] = 'transactions';

        return view('newdashboard.transactions', $data);
    }
    public function referral_program()
    {
        $data['user'] = $user = Auth::user();
        if ($user->email == 'fasanyafemi@gmail.com' || $user->email == 'ainae06@gmail.com' || $user->id == 50) {

            $data['transactions'] = AppUser::orderBy('referral_count', 'desc')->get();

            $data['active'] = 'referral_program';

            return view('newdashboard.referral_program', $data);
        } else {
            return "Access Denied";
        }
    }
    public function orderdetails($id)
    {
        $data['order'] = $order = Order::find($id);
        $data['carts'] = $carts = unserialize($order->cart);
        $data['active'] = 'orders';
        $data['user'] = Auth::user();
       
        if (is_array($carts) || is_object($carts)) {
            // If it's an array, check if the 'items' key exists
            if (is_array($carts) && isset($carts['items'])) {
                return view('dashboard.orderdetails', $data);
                return view('newdashboard.orderdetails', $data);
            }
            // If it's an object, check if the 'items' property exists
            if (is_object($carts) && property_exists($carts, 'items')) {
                return view('dashboard.orderdetails', $data);
                return view('newdashboard.orderdetails', $data);
            }
        }
        $data['carts'] = $carts[0];
   
        return view('dashboard.orderdetails', $data);
        return view('newdashboard.orderdetails2', $data);
        dd($carts);
        dd($carts);
    }
    public function record_day(Request $request)
    {

        if ($request->has('rest_id')) {
            $user = User::find($request->rest_id);
        } else {
            $user = Auth::user();
        }
        if ($request->end_date == null) {

            $orders = Order::where('user_id', $user->id)->whereBetween('created_at', [$request->start_date, Carbon::today()])->latest()->get();
        } else {
            $orders = Order::where('user_id', $user->id)->whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->get();
        }

        return $orders;
        if ($request->val == 'today') {
            $today = new  DateTime('today');
            $orders = Order::where('user_id', $user->id)->whereDay('created_at', $today)->get();
            return $orders;
        } elseif ($request->val == 'yesterday') {
            $today = new  DateTime('yesterday');
            $orders = Order::where('user_id', $user->id)->whereDay('created_at', $today)->get();
            return $orders;
        } elseif ($request->val == 'week') {

            $orders = Order::where('user_id', $user->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            return $orders;
        } elseif ($request->val == 'month') {
            $today = date('m');
            $orders = Order::where('user_id', $user->id)->whereMonth('created_at', $today)->get();
            return $orders;
        } else {
            $today = date('Y');
            $orders = Order::where('user_id', $user->id)->whereYear('created_at', $today)->get();
            return $orders;
        }
    }
}
