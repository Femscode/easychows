<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {
        $data['user'] = Auth::user();
        $data['categories'] = Category::where('user_id',Auth::user()->id)->orderBy('rank','asc')->get();
        $data['active'] = 'category';
        return view('dashboard.category',$data);
        return view('newdashboard.category',$data);
    }
    public function create(Request $request) {
        $this->validate($request, [
            'name' => ['required']
        ]);
        $check = Category::where('name', $request->name)->where('user_id',Auth::user()->id)->get();
        if($check->isEmpty()) {
            $category = Category::create(['name' => $request->name,'user_id'=>Auth::user()->id]);
        }
        
        return 'category created';
        return redirect()->back();


    }
    
    public function destroy(Request $request) {
        $id = $request->id;
        $category = Category::find($id);
        $food = Food::where('category_id',$id)->delete();
        $category->delete();
        return "Category deleted successfully";
    }

    public function edit(Request $request) {
        $id = $request->id;
        $category = Category::find($id);
        return $category;

    }
    public function update(Request $request) {
        $this->validate($request, [
            'name' => ['required'],
            'id' => ['required']
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        return $category;

    }
   
}
 