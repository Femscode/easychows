<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Models\WorkingHour;
use App\Http\Traits\CreateMenu;

trait CreateCategory
{
    use CreateMenu;
    public function create_category1($user, $selection) {
      

        $cat = Category::create(['name' => 'Soft drinks', 'user_id' => $user,'rank' => 8]);
      
        $this->create_menu($user, $cat->id, "Pepsi", "250", 'pepsi.jfif',8);
        $this->create_menu($user, $cat->id, "Fanta", "250", 'fanta.jfif',8);
        $this->create_menu($user, $cat->id, "Coca-cola", "250", 'coke.jfif',8);
        $this->create_menu($user, $cat->id, "7up", "250", '7up.jfif',8);
        $this->create_menu($user, $cat->id, "Bigi-apple", "250", 'bigi_apple.jfif',8);
        $this->create_menu($user, $cat->id, "Maltina", "250", 'maltina.jfif',8);
        $this->create_menu($user, $cat->id, "Five alive(puppy)", "300", 'five_alive_puppy.jfif',8);
        $this->create_menu($user, $cat->id, "Five alive(big)", "600", 'five_alive_big.jfif',8);
        $this->create_menu($user, $cat->id, "Origin Zero", "250", 'origin_zero.jfif',8);
        $this->create_menu($user, $cat->id, "Fayrouz", "250", 'fayrouz.jfif',8);

        $cat = Category::create(['name' => 'Alcoholic Drinks', 'user_id' => $user,'rank' => 9]);
        $this->create_menu($user, $cat->id, "Smirnoff", "250", 'smirnoff.jfif',9);
        $this->create_menu($user, $cat->id, "Trophy", "250", 'trophy.jfif',9);
        $this->create_menu($user, $cat->id, "Heneeky", "250", 'heneeky.jfif',9);
        $this->create_menu($user, $cat->id, "Bullet", "250", 'bullet.jfif',9);
        $this->create_menu($user, $cat->id, "Best Cream", "250", 'best.jfif',9);


        $cat = Category::create(['name' => 'Energy drinks', 'user_id' => $user,'rank' => 10]);
        $this->create_menu($user, $cat->id, "Fearless", "600", 'fearless.jfif',10);
        $this->create_menu($user, $cat->id, "Monster", "700", 'monster.jfif',10);
        $this->create_menu($user, $cat->id, "Amber", "350", 'amber.jfif',10);
        $this->create_menu($user, $cat->id, "Climax", "500", 'climax.jfif',10);
       
        $cat = Category::create(['name' => 'Meat & Fish', 'user_id' => $user,'rank' => 3]);
        $this->create_menu($user, $cat->id, "Turkey", "1500", 'Turkey.jfif',3);
        $this->create_menu($user, $cat->id, "Chicken", "1500", 'Chicken.jfif',3);
        $this->create_menu($user, $cat->id, "Cat Fish", "1500", 'fish.jfif',3);
        $this->create_menu($user, $cat->id, "Titus", "300", 'titus.jfif',3);
        $this->create_menu($user, $cat->id, "Ponmo", "100", 'ponmo.jfif',3);
        $this->create_menu($user, $cat->id, "Meat", "100", 'meat.jfif',3);
        $this->create_menu($user, $cat->id, "Egg", "100", 'egg.jfif',3);
        $this->create_menu($user, $cat->id, "Tinko", "250", 'tinko.jfif',3);


    }
    public function create_category_api($user,$selections) {
        $cat = Category::create(['name' => 'Food', 'user_id' => $user,'rank' => 7]);
        $this->create_menu($user, $cat->id, "Jollof Rice + Plantain + Chicken", "2400", 'jollof_rice.jfif',5);
        $this->create_menu($user, $cat->id, "Akara +  Bread", "2500", 'fanta.jfif',6);
        $this->create_menu($user, $cat->id, "3 In 1 Combo(Ice Cream)", "4500", 'ice_cream.jfif',6);
        $this->create_menu($user, $cat->id, "White Rice(Per Portion)", "500", 'coconut_rice.jfif',7);
        $this->create_menu($user, $cat->id, "Poundo(Per Portion)", "400", 'poundo.jfif',7);

        $cat = Category::create(['name' => 'Drinks', 'user_id' => $user,'rank' => 8]);
        $this->create_menu($user, $cat->id, "Pepsi", "250", 'pepsi.jfif',8);
        $this->create_menu($user, $cat->id, "Fanta", "250", 'fanta.jfif',8);
        $this->create_menu($user, $cat->id, "Coca-cola", "250", 'coke.jfif',8);
        $this->create_menu($user, $cat->id, "Monster", "500", 'monster.jfif',10);

    }
    public function create_category($user, $selections)
    {
        // dd($user, $selections);
       
        foreach ($selections as $category) {
            // dd($category);
           
            if ($category == 'Doughnut') {
                $cat = Category::create(['name' => 'Pasteries', 'user_id' => $user,'rank' => 5]);
                $this->create_menu($user, $cat->id, "doughnut", "100", 'doughnut.jfif',5);
                $this->create_menu($user, $cat->id, "Puff Puff", "200", 'puff_puff.jfif',5);
                $this->create_menu($user, $cat->id, "Egg Roll", "200", 'egg_roll.jfif',5);
                $this->create_menu($user, $cat->id, "Meat Pie", "200", 'meat_pie.jfif',5);
                $this->create_menu($user, $cat->id, "Chicken Pie", "200", 'chicken_pie.jfif',5);
            }
          
            if ($category == "Cakes") {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Cup Cakes", "200", 'cup_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Wedding Cake", "5000", 'wedding_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Ceremonial Cake", "2500", 'ceremonial_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Chocolate Cake", "500", 'chocolate_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Vanilla Cake", "500", 'vanilla_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Strawberry Cake", "500", 'strawberry_cake.jfif',3);
                $this->create_menu($user, $cat->id, "Plain Cake", "400", 'plain_cake.jfif',3);
            }
            if ($category == "Cocktails") {
                $cat = Category::create(['name' => 'Cocktails & Mocktails', 'user_id' => $user,'rank' => 4]);
                $this->create_menu($user, $cat->id, "Cocktails", "500", 'cocktails.jfif',4);
                $this->create_menu($user, $cat->id, "Mocktails", "700", 'mocktails.jfif',4);
            }
            if ($category == "Meat_pie") {
                $cat = Category::create(['name' => 'Meat & Chicken Pie', 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Meat Pie", "250", 'meat_pie.jfif',3);
                $this->create_menu($user, $cat->id, "Chicken Pie", "250", 'chicken_pie.jfif',3);
            }
           

            if ($category == "Ice Cream") {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 4]);
                $this->create_menu($user, $cat->id, "Chocolate Flavour Ice Cream", "750", 'ice_cream.jfif',4);
                $this->create_menu($user, $cat->id, "Vanilla Flavour Ice Cream", "1250", 'ice_cream.jfif',4);
                $this->create_menu($user, $cat->id, "Strawberry Flavour Ice Cream", "1250", 'ice_cream.jfif',4);
            }
            if ($category == "Pap and Tabioka") {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 4]);
                $this->create_menu($user, $cat->id, "Pap", "250", 'pap.jfif',4);
                $this->create_menu($user, $cat->id, "Tabioka", "250", 'cabioka.jfif',4);
                $this->create_menu($user, $cat->id, "hollandia Milk", "250", 'hollandia.jfif',4);
                $this->create_menu($user, $cat->id, "Peak Milk", "250", 'peak_milk.jfif',4);
                $this->create_menu($user, $cat->id, "Three Crown Milk", "300", 'three_crown.jfif',4);
                $this->create_menu($user, $cat->id, "Akara", "50", 'akara.jfif',4);
                $this->create_menu($user, $cat->id, "Moi-Moi", "200", 'moi_moi.jfif',4);
            }
            if ($category == 'Ewa Agonyin') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);

                $this->create_menu($user, $cat->id, "Beans", "200", 'bread_and_beans.jfif',3);
                $this->create_menu($user, $cat->id, "Bread", "250", 'bread.jfif',3);
            }
            if ($category == 'Bread and Akara') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);

                $this->create_menu($user, $cat->id, "Akara", "50", 'akara.jfif',3);
                $this->create_menu($user, $cat->id, "Bread", "250", 'bread.jfif',3);
            }
            if ($category == 'Pepper Soup') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);

                $this->create_menu($user, $cat->id, "Fish Peppersoup", "1000", 'fish_peppersoup.jfif',3);
                $this->create_menu($user, $cat->id, "Chicken Peppersoup", "1250", 'chicken_peppersoup.jfif',3);
            }
            if ($category == 'Soup') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 4]);

                $this->create_menu($user, $cat->id, "Egusi Soup", "1000", 'egusi_soup.jfif',4);
                $this->create_menu($user, $cat->id, "Ewedu Soup", "1000", 'ewedu_soup.jfif',4);
                $this->create_menu($user, $cat->id, "Efo Riro Soup", "1000", 'efo_riro.jfif',4);
                $this->create_menu($user, $cat->id, "Ogbona Soup", "1000", 'ogbona.jfif',4);
            }
            if ($category == "Toast_bread") {
                $cat = Category::create(['name' => 'Toast Bread', 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Mini Toast Bread", "250", 'toast_bread.jfif',3);
                $this->create_menu($user, $cat->id, "Max Toast Bread", "250", 'toast_bread.jfif',3);
            }
            if ($category == "Shawarma") {
                $cat = Category::create(['name' => 'Shawarma and Pizza', 'user_id' => $user,'rank' => 2]);
                $this->create_menu($user, $cat->id, "Shawarma", "1250", 'shawarma.jfif',2);
                $this->create_menu($user, $cat->id, "Pizza", "2250", 'pizza.jfif',2);
            }
            if ($category == "Grillz") {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Chicken Grillz", "1250", 'chicken_grillz.jfif',3);
                $this->create_menu($user, $cat->id, "Fish Grillz", "2250", 'fish_grillz.jfif',3);
            }
            if ($category == "Chicken and Chips") {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 2]);
                $this->create_menu($user, $cat->id, "Chicken and Chips(Small)", "1250", 'chicken_and_chips.jfif',2);
                $this->create_menu($user, $cat->id, "Chicken and Chips(Medium)", "1700", 'chicken_and_chips.jfif',2);
                $this->create_menu($user, $cat->id, "Chicken and Chips(Big)", "2200", 'chicken_and_chips.jfif',2);
            }
           
            if ($category == 'Porridge') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Porridge", "200", 'porridge.jfif',3);
            }
           
            if ($category == 'Swallows') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 3]);
                $this->create_menu($user, $cat->id, "Eba", "200", 'eba.jfif',3);
                $this->create_menu($user, $cat->id, "Amala", "200", 'amala.jfif',3);
                $this->create_menu($user, $cat->id, "Semo", "200", 'semo.jfif',3);
                $this->create_menu($user, $cat->id, "Poundo", "200", 'poundo.jfif',3);
                $this->create_menu($user, $cat->id, "Egusi Soup", "0", 'egusi_soup.jfif',3);
                $this->create_menu($user, $cat->id, "Ewedu Soup", "0", 'ewedu_soup.jfif',3);
                $this->create_menu($user, $cat->id, "Efo Riro Soup", "0", 'efo_riro.jfif',3);
                $this->create_menu($user, $cat->id, "Ogbona Soup", "0", 'ogbona.jfif',3);
            }
            if ($category == "Salad") {
                $cat = Category::create(['name' => "Moi-Moi & Salad", 'user_id' => $user,'rank' => 2]);
                $this->create_menu($user, $cat->id, "Salad", "200", 'salad.jfif',2);
                $this->create_menu($user, $cat->id, "Moi Moi", "200", 'moi_moi.jfif',2);
            }
            if ($category == 'Rice') {
                $cat = Category::create(['name' => $category, 'user_id' => $user,'rank' => 1]);

                $this->create_menu($user, $cat->id, "Fried Rice", "200", 'fried_rice.jfif',1);
                $this->create_menu($user, $cat->id, "Jollof Rice", "200", 'jollof_rice.jfif',1);
                $this->create_menu($user, $cat->id, "White Rice", "200", 'coconut_rice.jfif',1);
            }
        }
       

        // return 'category created';
        // return redirect()->back();
    }
    public function create_working_hours($user_id) {
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Monday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Tuesday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Wednesday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Thursday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Friday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Saturday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
        WorkingHour::create([
            'vendor_id' => $user_id,
            'day' => "Sunday",
            'availability' => 1,
            'opening_hour' => "09:00:00",
            'closing_hour' => "21:00:00"
        ]);
    }
}
