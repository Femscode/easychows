<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Delivery;
use App\Models\Food;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Models\DeliveryLocation;
use App\Models\Discount;
use Illuminate\Http\Request;

use App\Models\School;

class CartController extends Controller
{
    public function menuplate(Request $request)
    {
        $id = $request->id;
        $myA = [];
        if (session()->has('cart')) {
            $plates = session()->get('cart')->items;
            foreach ($plates as $plate)
                // if($id == $plate['plate']) {
                if (in_array($id, $plate['plate'])) {
                    array_push($myA, $plate);
                }
        }
        return $myA;
    }
    public function deleteplate(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        // dd($cart,$id);
        $rcart = new Cart(session()->get('cart'));
        if (session()->has('cart')) {
            $cart_item = session()->get('cart')->items;
            foreach ($cart_item as $plate) {
                // if($id == $plate['plate']) {
                for ($i = 0; $i <= 10; $i++) {

                    if (in_array($id, $plate['plate'])) {

                        $key = array_search($id, $plate['plate']);
                        // dd($key,$id,$plate);
                        // dd($plate['plate']);
                        array_splice($plate['plate'], $key, 1);
                        // dd($plate['plate'],$plate);
                        $plateid = $plate['id'];
                        $items = $rcart->items;
                        // dd($items['14']['plate'],$plateid);

                        $price = intval($items[$plateid]['price']);
                        // dd(intval($price));
                        unset($items[$plateid]);
                        $ritems = array_add($items, $plateid, $plate);
                        // dd($ritems,$items,'the guru the',$plate,$plateid);

                        //delete element in array by value "green"
                        //you are almost there, just make sure you find a way to remove $plateid index from $rcart->items
                        //and then putit back to the $rcart as a main

                        // dd($rcart->items);
                        $rcart->totalQty -= 1;
                        $rcart->totalPrice -= $price;
                        $rcart->items = $ritems;
                        // dd($rcart);
                        session()->forget('cart');
                        session()->put('cart', $rcart);
                        // dd($rcart,$plate['id'],$plate['qty']-1);

                        // $rcart->update(['items' => $ritems]);


                        //   dd($plate['plate']);

                        //here is the code that removes the plate from the cart
                        //   dd($plate['plate']);

                        // session()->put('cart', $plate['plate']);
                        // array_push($myA, $plate);
                        // dd($plate,$rcart);

                        $gg =  $rcart->updateQty2($plate['id'], $plate['qty'] - 1);
                        // dd($rcart);
                        // $gg =  $rcart->updateQty($plate['id'], $item_quantity);
                        session()->forget('cart');
                        session()->put('cart', $rcart);

                        // dd($gg,session()->get('cart'));
                        //pelumi oo

                        //I am trying to get all the rcart items then remove the one that has an id of the plate
                        //delete it and then push it back, but the problem is that, it will affect the array index
                        session()->forget('pack[' . $id . ']');
                    }
                } //here

            }
        }
        // $arrD = array_diff($rcart->items,$myA);

        return $rcart->totalPrice;
    }
    public function addPlate()
    {

        if (session()->has('plates')) {
            session()->push('plates', ['plate1' => 2]);
        } else {
            session()->put('plates', []);
            session()->push('plates', ['plate1' => 1]);
        }
        // dd(session()->get('plates'));
    }

    public function multiplyPlate(Request $request)
    {

        if (session()->has('plates')) {
            session()->push('plates', ['plate1' => 2]);
        } else {
            session()->put('plates', []);
            session()->push('plates', ['plate1' => 1]);
        }
        $cart = new Cart(session()->get('cart'));
        $items = session()->get('cart')->items;

        $current = intval($request->current);
        foreach ($items as $item) {
            $food = Food::find($item['id']);
            $t_plate = count($item['plate']);

            for ($i = 0; $i < $t_plate; $i++) {
                if ($item['plate'][$i] == $current - 1) {
                    $cart->add($food, $current);
                }
            }

            session()->put('cart', $cart);
            if (session()->has('pack[' . $current . ']')) {
                $s = session()->get('pack[' . $current . ']');
                $si = $s + 1;
                session()->put('pack[' . $current . ']', $si);
            } else {
                session()->put('pack[' . $current . ']', 1);
            }
        }
        return array($cart->totalQty, $cart->totalPrice);
    }
    public function addToCart(Food $food)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($food);
        session()->put('cart', $cart);
        // dd($cart, session()->get('cart'));
        return redirect()->back();
    }
    public function addToCart2(Request $request)
    {
        // $id = $request->id;
        // $plate = $request->good;
        $id  = explode(',', $request['data'], 2)[0];
        $plate  = explode(',', $request['data'], 2)[1];
        $food = Food::find($id);

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($food, $plate);

        session()->put('cart', $cart);
        if (session()->has('pack[' . $plate . ']')) {
            $s = session()->get('pack[' . $plate . ']');
            $si = $s + 1;
            session()->put('pack[' . $plate . ']', $si);
        } else {
            session()->put('pack[' . $plate . ']', 1);
        }
        // dd($cart->totalQty);
        // dd($cart, session()->get('cart'));
        return array($cart->totalQty, $cart->totalPrice);
        return redirect()->back();
    }
    public function addToCart3(Request $request)
    {
        $id  = explode(',', $request['data'], 2)[0];
        $plate  = explode(',', $request['data'], 2)[1];
        $food = Food::find($id);

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($food, $plate);

        session()->put('cart', $cart);
        if (session()->has('pack[' . $plate . ']')) {
            $s = session()->get('pack[' . $plate . ']');
            $si = $s + 1;
            session()->put('pack[' . $plate . ']', $si);
        } else {
            session()->put('pack[' . $plate . ']', 1);
        }
        // dd($cart, session()->get('cart'));

        return $cart->totalPrice;
    }
    public function removeMenu(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $plate = $request->plate;
        // dd($request->all());
        $food = Food::find($id);

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $realfood = $cart->items[$id];
        unset($cart->items[$id]);
        $realplate = $realfood['plate'];
        $key2 = array_search($plate, $realplate);
        array_splice($realplate, $key2, 1);

        $realfood['plate'] = $realplate;
        $ritem = array_add($cart->items, $id, $realfood);
        $cart->items = $ritem;
        session()->put('cart', $cart);
        $quantity = $cart->items[$id]['qty'];

        // dd($cart->items,$cart);

        //what is meant to be done here is that, once a product is removed, it should check the $cart->plate
        //and decrement the value of the quantity of that plate id, secondly, the quantity of the food will be reduced.
        //pelumi o
        // dd($quantity);
        if ($quantity == 1) {
            $cart->remove($food->id);
            if ($cart->totalQty <= 0) {
                session()->forget('cart');
            } else {
                session()->put('cart', $cart);
            }

            // return 404;
            return $cart->totalPrice;
        } else {

            $cart->updateQty($food->id, $quantity - 1);
        }
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        //here is where we'd deal with the packs and plates
        if (session()->has('pack[' . $plate . ']')) {
            $s = session()->get('pack[' . $plate . ']');
            $si = $s - 1;
            session()->put('pack[' . $plate . ']', $si);
        } else {
            session()->put('pack[' . $plate . ']', 1);
        }
        return $cart->totalPrice;
    }
    public function removeMenu2(Request $request)
    {
        $values = explode(",", $request->value);
        $id = $values[0];
        $qty = $values[1];
        $plate = $values[2];
        // dd($request->all());
        $food = Food::find($id);

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $realfood = $cart->items[$id];
        unset($cart->items[$id]);
        $realplate = $realfood['plate'];
        $key2 = array_search($plate, $realplate);
        array_splice($realplate, $key2, 1);

        $realfood['plate'] = $realplate;
        $ritem = array_add($cart->items, $id, $realfood);
        $cart->items = $ritem;
        session()->put('cart', $cart);
        $quantity = $cart->items[$id]['qty'];

        // dd($cart->items,$cart);

        //what is meant to be done here is that, once a product is removed, it should check the $cart->plate
        //and decrement the value of the quantity of that plate id, secondly, the quantity of the food will be reduced.
        //pelumi o
        if ($quantity == 1) {
            $cart->remove($food->id);
            if ($cart->totalQty <= 0) {
                session()->forget('cart');
            } else {
                session()->put('cart', $cart);
            }
            //here is the normal one which will return 404
            //return 404
            return $cart->totalPrice;
        } else {

            $cart->updateQty($food->id, $quantity - 1);
        }
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        //here is where we'd deal with the packs and plates
        if (session()->has('pack[' . $plate . ']')) {
            $s = session()->get('pack[' . $plate . ']');
            $si = $s - 1;
            session()->put('pack[' . $plate . ']', $si);
        } else {
            session()->put('pack[' . $plate . ']', 1);
        }
        return $cart->totalPrice;
    }

    public function showCart()
    {

        if (session()->has('cart')) {
            $data['carts'] =  $cart = new Cart(session()->get('cart'));
        } else {
            return redirect()->back()->with('message', 'Empty Cart!');
            $data['carts'] = $cart = null;
        }

        $data['schools'] = School::all();

        $data['rest'] = $rest = User::find($cart->restaurant);

        for ($i = 0; $i <= 10; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {

                if (in_array($i, $item['plate'])) {
                    $tmp = array_count_values($item['plate']);
                    $cnt = $tmp[$i];

                    $item['qty'] = $cnt;
                    array_push($pack[$i], $item);
                }
            }
        }
        $cc = 0;
        for ($j = 0; $j <= 10; $j++) {
            if (session()->has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                $cc += 1;
            }
        }
        $data['cc'] = $cc;
        // dd($data, $pack[1], $pack[2],session()->all());
        // $discount = Discount::find(1);
        if ($rest->bonus >= 1) {
            $data['promo'] = true;
            $data['discount'] = 'true';
            $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
            $rest->bonus -= 1;
            $rest->save();
        } else {
            $data['promo'] = false;
            $data['discount'] = 'false';
            $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
            // $data['del'] = Delivery::where('user_id',$rest->id)->first();
        }
        $data['deliveries'] = DeliveryLocation::where('user_id', $rest->id)->get();
        //    dd($data['promo']);
        // if ($rest->user_type == 'api_vendor') {
        //     $data['vendor_image'] = User::find($rest->assigned)->first()->image;
        //     return view('frontend.cart_api', $data);
        // }
        if($rest->id == 10085) {
            $data['promo'] = true;
            $data['discount'] = 'true';
            $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
            $rest->bonus -= 1;
            $rest->save();
            
            return view('frontend.cart_free_drink', $data);
        }
        else {
            return view('frontend.cart', $data);
        }
    }
    public function put_session(Request $request) {
        {
          
            Session::flush();
    
            $data['session'] = $sessionData = unserialize(json_decode($request->mysession));
            // dd($request->all(),json_decode($request->mysession),  $sessionData);
            //    dd($sessionData);
            // Set the retrieved session data in the current session
            Session::put($sessionData);
    
            if (Session::has('cart')) {
                $data['carts'] =  $cart = new Cart(Session::get('cart'));
            } else {
                return redirect()->back()->with('message', 'Empty Cart!');
                $data['carts'] = $cart = null;
            }
    
            $data['rest'] = $rest = User::find($cart->restaurant);
            $foods = Food::where('user_id', $cart->restaurant)->where('available', 0)->get();
            // dd(Session::all(), Session::get('cart')->items,$foods);
    
    
            for ($i = 0; $i <= 10; $i++) {
                $pack[$i] = [];
                foreach ($cart->items as $item) {
    
                    if (in_array($i, $item['plate'])) {
                        //out of stock begins
    
    
                        $itemName = $item['name'];
                        // dd($item['plate'],$itemName);
                        foreach ($foods as $foodItem) {
                            if ($foodItem->name === $itemName) {
                                $item['name'] .= "(Out Of Stock)";
                                $item['id'] = 0.1;
                                $cart->totalPrice -= $item['price'];
                                session()->get('cart')->totalPrice -=$item['price'];
                                session()->get('cart')->totalQty -=$item['qty'];

                                break;
                            }
                        }
    
                        //end of out of stock
    
    
    
    
                        $tmp = array_count_values($item['plate']);
                        $cnt = $tmp[$i];
    
                        $item['qty'] = $cnt;
                        array_push($pack[$i], $item);
                    }
                }
                // dd($item);
            }
            $cc = 0;
            for ($j = 0; $j <= 10; $j++) {
                if (Session::has('pack[' . $j . ']')) {
    
                    $data['pack' . $j . ''] = $pack[$j];
                    $cc += 1;
                }
            }
            $data['cc'] = $cc;
            // dd($data, $pack[1], $pack[2],Session::all());
            // $discount = Discount::find(1);
            if ($rest->bonus >= 1) {
                $data['promo'] = true;
                $data['discount'] = 'true';
                $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
                $rest->bonus -= 1;
                $rest->save();
            } else {
                $data['promo'] = false;
                $data['discount'] = 'false';
                $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
                // $data['del'] = Delivery::where('user_id',$rest->id)->first();
            }
            $data['deliveries'] = DeliveryLocation::where('user_id', $rest->id)->get();
            // return redirect()->route('showCartApi'.$request->mysession);
            // dd(session()->all(),$request->mysession,serialize(json_encode(session()->all())));
            return redirect()->route('showCartApi',['my_saved_order' => serialize(session()->all())]);
            // ->with(['mysession' => ]);
      
        }
    }

    public function showCartApi(Request $request)
    {
        Session::flush();
         $data['session'] = $sessionData = unserialize($request->my_saved_order);
         Session::put($sessionData);

        if (Session::has('cart')) {
            $data['carts'] =  $cart = new Cart(Session::get('cart'));
        } else {
            return redirect()->back()->with('message', 'Empty Cart!');
            $data['carts'] = $cart = null;
        }

        $data['rest'] = $rest = User::find($cart->restaurant);
        $foods = Food::where('user_id', $cart->restaurant)->where('available', 0)->get();
        // dd(Session::all(), Session::get('cart')->items,$foods);


        for ($i = 0; $i <= 10; $i++) {
            $pack[$i] = [];
            foreach ($cart->items as $item) {

                if (in_array($i, $item['plate'])) {
                    //out of stock begins


                    $itemName = $item['name'];
                    // dd($item['plate'],$itemName);
                    foreach ($foods as $foodItem) {
                        if ($foodItem->name === $itemName) {
                            $item['name'] .= "(Out Of Stock)";
                            $item['id'] = 0.1;
                         
                            break;
                        }
                    }

                    //end of out of stock




                    $tmp = array_count_values($item['plate']);
                    $cnt = $tmp[$i];

                    $item['qty'] = $cnt;
                    array_push($pack[$i], $item);
                }
            }
            // dd($item);
        }
        $cc = 0;
        for ($j = 0; $j <= 10; $j++) {
            if (Session::has('pack[' . $j . ']')) {

                $data['pack' . $j . ''] = $pack[$j];
                $cc += 1;
            }
        }
        $data['cc'] = $cc;
        // dd($data, $pack[1], $pack[2],Session::all());
        // $discount = Discount::find(1);
        if ($rest->bonus >= 1) {
            $data['promo'] = true;
            $data['discount'] = 'true';
            $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
            $rest->bonus -= 1;
            $rest->save();
        } else {
            $data['promo'] = false;
            $data['discount'] = 'false';
            $data['order_promo_id'] = substr(str_shuffle("012ABCD3456EFGHIJKLMNOP7890ZXVNM"), 0, 5);
            // $data['del'] = Delivery::where('user_id',$rest->id)->first();
        }
        $data['deliveries'] = DeliveryLocation::where('user_id', $rest->id)->get();

        //    dd($data['promo']);
        if ($rest->user_type == 'api_vendor') {
            $data['vendor_image'] = User::find($rest->assigned)->first()->image;
            return view('frontend.cart_api', $data);
        } else {
            return view('frontend.loadcart', $data);
        }
    }
    public function updatecart(Request $request)
    {

        $id = $request->id;
        $qty = $request->qty;
        $food = Food::find($id);
        $cart  = new Cart(session()->get('cart'));



        $cart->updateQty($food->id, $qty);
        // dd($cart, $product->id,$qty);

        session()->put('cart', $cart);

        return $cart->totalPrice;
    }
    public function deletecart(Request $request)
    {
        $id = $request->id;
        $product = Food::find($id);

        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }
        return $cart->totalPrice;
    }
    public function cancelcart()
    {
        if (session()->has('cart')) {
            session()->flush();
        }
        session()->flush();
        return 'cart_removed';
        return redirect()->route('home');
    }
}
