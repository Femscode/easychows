<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
      
        
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'address' => ['required'],
            'restaurant_category' => ['required'],
        ])->validate();
        
      
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'address' => $input['address'],
            'restaurant_category' => $input['restaurant_category'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
