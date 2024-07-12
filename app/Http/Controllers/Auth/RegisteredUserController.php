<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Traits\CreateCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;


class RegisteredUserController extends Controller
{
    use CreateCategory;
    


    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());
      
      
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required'],
            'phone' => ['required'],
            'school' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $random_id = mt_rand(5000, 20000);
        // dd($random_id);
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path() . '/profilePic', $imageName);
            $user = User::create([
                'id' => $random_id,
                'name' => $request->name,
                'slug' => ucwords(str_replace(' ', '-', $request->name)),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'school' => $request->school,
                'image' => $imageName,
               
               
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'id' => $random_id,
                'name' => $request->name,
                'slug' => ucwords(str_replace([' ',"'"], '', $request->name)),
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'school' => $request->school,
               
                'password' => Hash::make($request->password),
            ]);
        }

      
       
        // event(new Registered($user));
        $email = $request->email;
       
      
        $this->create_working_hours($random_id);

      
        Auth::login($user);
       
        
        $data = array('name' => $request->name, 'slug' => ucwords(str_replace(' ', '', $request->name)));
       
        // Mail::send('mail.welcome', $data, function ($message) use ($email) {
        //     $message->to($email, '')->subject('Welcome to EasyChows');
        //     $message->from('support@easychows.com', 'EasyChows');
        // });
        // register on the app

        




        return redirect(RouteServiceProvider::HOME);
    }

  
}
