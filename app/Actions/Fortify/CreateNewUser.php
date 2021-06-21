<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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

        $result = User::all();
        $position;
        if(count($result) == 0){
            $position = 'pustakawan';
        }else{
            $position = 'member';
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'identity_number' => ['required'],
            'identity_type' => ['required'],
            'birth_place' => ['required'],
            'date_of_birth' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'institution' => ['required'],
            'institution_address' => ['required'],
            'gender' => ['required'],
            'profession' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'identity_number' => $input['identity_number'],
            'identity_type' => $input['identity_type'],
            'birth_place' => $input['birth_place'],
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'phone_number' => $input['phone_number'],
            'institution' => $input['institution'],
            'institution_address' => $input['institution_address'],
            'gender' => $input['gender'],
            'profession' => $input['profession'],
            'position' => $position,
            'password' => Hash::make($input['password']),
        ]);
    }
}
