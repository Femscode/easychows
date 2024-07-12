<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Models\Food;


trait CreateMenu
{
    public function create_menu($user, $cat_id, $name, $price, $image,$rank)
    {
      
        $food =  Food::create([
            'user_id' => $user,
            'category_id' => $cat_id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'rank' => $rank
        ]);
    }
}
