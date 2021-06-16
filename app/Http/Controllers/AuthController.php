<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\super_admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
 
    public function register(Request $request){

        //validate input field
        $field=$request->validate([
            'name'=> 'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed' ]
        );


        //create user model and store db
        $user=User::create([

            'name'=>$field['name'],
            'email'=>$field['email'],
            'password'=>bcrypt($field['password'])
 
        ] );
        
        //create token
        $token = $user->createToken('busapptoken')->plainTextToken;
        //res user and token
        $response=[
            'user'=>$user,
            'token'=>$token
        ];

         return response($response,201);
 
    }



    public function logout(Request $request){
      
        //delete current access token
        $request->user()->currentAccessToken()->delete();
     
        return [
            'message'=>'log out'
        ];

    }


    public function login(Request $request){

        //validate input field
        $field=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string' ]
        );
        
        //find the  email and get user data
        $user=User::where('email',$field['email'])->first();
        //find the  email and get admin data
        $admin=super_admin::where('email',$field['email'])->first();



        


        if($user && Hash::check($field['password'], $user->password)){
         //create token
        $token=$user->createToken('busapptoken')->plainTextToken;
        }elseif ($admin && Hash::check($field['password'], $admin->password)) {
            //create token
        $token=$admin->createToken('busapptoken')->plainTextToken;
        }else{
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

      


   
        //res user and token
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }

    
    


    

}

