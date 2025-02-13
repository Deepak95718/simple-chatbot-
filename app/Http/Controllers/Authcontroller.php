<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class Authcontroller extends Controller
{
   public function index()
   {
      if (Auth::check()) {
         return redirect()->route('home');
      } else {
         return view('auth.login');
      }
   }
   public function register()
   {
      return view("auth.register");
   }
   public function checkauth(Request $request)
   {

      if (auth::attempt($request->only('email', 'password'))) {
         return redirect()->route('home');
      } else {
         return redirect()->route('login')->withErrors(['email' => 'Invalid credentials']);
      }

   }
   public function registerauth(Request $request)
   {
      $request->validate([
         'email' => 'string|email|unique:users',
         'password' => 'required|string|min:8',
      ]);

      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
      ]);
      if (auth::attempt($request->only('email', 'password'))) {
         return redirect()->route('home');
      } else {
         return redirect()->route('login')->withErrors(['email' => 'Invalid credentials']);
      }
   }


   function home()
   {
      return view('welcome');
   }
   function logout()
   {
      session()->flush();
      return redirect()->route('login');
   }

   function forgotPassword()
   {
      return view('auth.forgotpassword');
   }

   function sendresetlink(Request $request)
   {
      $request->validate([
         'email' => 'required|email|exists:users,email',
      ]);
      $token = Str::random(64);
      $time = Carbon::now()->addMinutes(5);
      User::where('email', $request->email)->update(['remember_token' => $token, 'token_expires_at' => $time]);
      // print_r($token);die;
      $url = route('resetpassword', ['token' => $token]);

      Mail::html("
       Forgot Your Password? Don't worry, we've got you! Click on the link below to reset your password:<br><br>
       <a href='{$url}' style='display:inline-block;padding:10px 15px;background:#3498db;color:#fff;text-decoration:none;border-radius:5px;'>
           Reset Password
       </a>
   ", function ($message) use ($request) {
         $message->to($request->email)
            ->subject('Forgot Password Reset Link');
      });
      return redirect('/');
   }

   function showResetForm(Request $request)
   {
      $token = $request->token;
      $resetData = User::where('remember_token', $token)
         ->where('token_expires_at', '>', Carbon::now())
         ->first();

      if (!$resetData) {
         return redirect('/')->with('error', 'The password reset link has expired or is invalid.');
      }
      return view('auth.resetpassword', ['token' => $token, 'email' => $resetData->email]);

   }

   function resetpassword(Request $request)
   {
      $oldpass = $request->oldpassword;
      $newpass = $request->newpassword;
      $confirmpass = $request->confirmpassword;
      $token = $request->token;
      if ($newpass != $confirmpass) {
         return redirect()->route('resetpassword', ['token' => $token])->with('error', 'Password and Confirm Password does not match');
      }

      User::where('email', $request->email)->update(['remember_token' => null, 'token_expires_at' => null, 'password' => Hash::make($newpass)]);
      return redirect()->route('login');

   }
}
