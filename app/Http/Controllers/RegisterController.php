<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;

use JWTAuth;

class RegisterController extends Controller
{
    public function register(UserStoreRequest $request) {
        
        // check that the user with the email does not exist
        
        $currentUser = User::where('email', $request['email'])->first();
        
        if($currentUser !== null){

            return response()
                   ->json(["message" => "User with that email already exists"]);

        } else {
            
            $user = $this->create($request->all());
            
            return $this->registered($request, $user);
        }
    }


    protected function registered(Request $request, $user)
    {

        // generate token
        $token = JWTAuth::fromUser($user);
        
        return response()->json(['token' => $token, 'userName' => $user["name"]], 201);
    
    }

    /**
     * Create a new user after valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login(LoginRequest $request){

        // check that the user exists, if the user does not exist,
        //  an error message will be sent

        $user = User::where('email', $request['email'])->firstOrFail();

        // else we should check that the passwords are the same
        if(!Hash::check($request['password'], $user->password)){

            return response()->json(["message" => "The passwords don't match"], 401);

        } else {

            // we can return a token
            return $this->registered($request, $user);

        };

    }
}
