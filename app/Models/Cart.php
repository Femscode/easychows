<?php
namespace App\Models;
class Cart {
    public $items = [];
    public $totalQty;
    public $totalPrice;
    public $restaurant;
    public $plate;

public function __construct($cart=null) {
    if($cart) {
        $this->items = $cart->items;
        $this->totalPrice = $cart->totalPrice;
        $this->totalQty = $cart->totalQty;
        $this->restaurant = $cart->restaurant;
        $this->plate = 1;
    }   
    else {
        $this->items = [];
        $this->totalQty = 0;
        $this->totalPrice = 0;
        $this->restaurant = '';
        $this->plate = '1';
    }
}
public function add($product,$plate) {
    
    if($plate == "") {
      $plate = 1;
    } else {
    $plate = (int)$plate;
    }
   
    $item = [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'image' => $product->image,
        'qty' => 0,
        'plate' => array($plate),
     
    ];

    if(!array_key_exists($product->id,$this->items)) {
        $this->items[$product->id] = $item;
        $this->totalQty += 1;
        $this->totalPrice += $product->price;
        // dd($this->items[$product->id]);
    }
    else {
       $this->totalQty += 1;
        $this->totalPrice += $product->price;
        $fplate = $this->items[$product->id]['plate'];
      
       array_push($fplate, $plate);
        
        $this->items[$product->id]['plate'] = $fplate;
      
    }
  
  $this->restaurant = $product->user_id;
  $this->items[$product->id]['qty'] += 1;
 
}
public function updateQty($id,$qty) {
    $this->totalQty -= $this->items[$id]['qty'];
    $this->totalPrice -= $this->items[$id]['price']*$this->items[$id]['qty'];
    $this->items[$id]['qty'] = $qty;
    $this->totalQty += $qty;
    $this->totalPrice+=$this->items[$id]['price'] * $qty;
}
public function updateQty2($id,$qty) {
    $this->items[$id]['qty'] = $qty;
}
public function remove($id) {
    if(array_key_exists($id,$this->items)) {
    $this->totalQty -= $this->items[$id]['qty'];
    $this->totalPrice -= $this->items[$id]['qty']*$this->items[$id]['price'];
    unset($this->items[$id]);
}
}

}
?>











































