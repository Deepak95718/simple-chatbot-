<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
   function redirect(){
    return Socialite::driver('google')->redirect();

   }

   function callbackgoogle(){

    $google_user = Socialite::driver('google')->user();
    $user = User::where('google_id', $google_user->getid())->first();
    if(!$user){
        $newuser = User::create([
            "name" => $google_user->getName(),
            "email" =>  $google_user->getEmail(),
            "password" => '12345',
            "google_id" => $google_user->getid(),
        ]);
        auth()->login($newuser);
        return redirect()->route('home');
    }
    else{
        auth()->login($user);
        return redirect()->route('home');
    }
   }
}
