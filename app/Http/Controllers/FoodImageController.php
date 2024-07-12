<?php

namespace App\Http\Controllers;
use App\Models\FoodImage;
use Illuminate\Http\Request;

class FoodImageController extends Controller
{
    public function create(Request $request) {
        $this->validate($request,[
            'category' => 'required',
            'image' => 'required'
        ]);
        $image = $request->image;
        $imagename = $image->hashName();
        $image->move(public_path().'/foodimages/',$imagename);

        FoodImage::create(['category'=>$request->category,'image'=>$imagename]);
        return redirect()->back()->with('message','Image Created Successfully');

    }
    public function view() {
        $data['foodimages'] = FoodImage::latest()->get();
        return view('superadmin.foodimages',$data);

    }
    public function searchfoodimage(Request $request) {
        $val = $request->val;
        // dd($val);
        $foodImages = FoodImage::where('category',$val)->orWhere('category','like','%'.$val.'%')->get();
        
        return $foodImages;
    }
    public function delete($id) {

    }

}
