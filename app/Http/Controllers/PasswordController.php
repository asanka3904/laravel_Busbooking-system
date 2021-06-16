<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\super_admin;


class PasswordController extends Controller
{
   
 // //show password reset view page
   public  function get_reset(){
      return ['message'=>'foget password'];
   }


  //post requuest from email

   public function foget_password(Request $request){
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
   }





  
  //show token view page
   public function get_token($token){
     return  response(['token' => $token]);
   }




   //reset password
   public function form_submit(Request $request){
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);


   
     //find the  email and get user data
     $user=User::where('email',$request->only('email'))->first();
     //find the  email and get admin data
     $admin=super_admin::where('email',$request->only('email'))->first();
    
  if($user){
   //change user new password
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

  }else{
       //change admin new password
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($admin, $password) {
            $admin->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $admin->save();

            event(new PasswordReset($admin));
        }
    );
  }
  

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
   }

}
