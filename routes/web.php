<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/logout',[Authcontroller::class,'logout'])->name('logout');
Route::group(['middleware'=>'guest'], function () {
    Route::get('/',[Authcontroller::class,'index'])->name('login')->middleware('throttle:21,1');    
});

Route::get('register',[Authcontroller::class,'register'])->name('register');

Route::post('/checkauth',[Authcontroller::class,'checkauth'])->name('checkauth');

Route::post('/registerauth',[AuthController::class,'registerauth'])->name('registerauth');
Route::group(['middleware'=>'auth'], function () {
    
Route::get('/home',[Authcontroller::class,'home'])->name('home');



});

Route::get('/auth/google', [GoogleAuthController::class,'redirect']);
Route::get('/forgot',[Authcontroller::class,'forgotPassword'])->name('forgot_password');
Route::get('/auth/google/callback', [GoogleAuthController::class,'callbackgoogle']);
Route::post('/sendresetlink',[Authcontroller::class,'sendResetLink'])->name('sendresetlink');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('resetpassword');

Route::post('/updatepassword', [AuthController::class, 'resetpassword'])->name('updatepassword');
Route::post('/chatbot', [ChatbotController::class, 'getResponse'])->name('chatbot.response');