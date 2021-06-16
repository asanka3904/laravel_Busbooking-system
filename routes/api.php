<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AuthController;
use app\Http\Controllers\BusController;
use app\Http\Controllers\Bus_routesController;
use app\Http\Controllers\Bus_schedulesController;
use app\Http\Controllers\Bus_seatesController;
use app\Http\Controllers\RoutesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PasswordController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/








Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




//public route

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//Route::resource('bus_shedules', 'Bus_schedulesController');
//only show index and show
Route::resource('bus_shedules', 'Bus_schedulesController')->only([
    'index', 'show'
]);;

Route::resource('booking','BookingController');



//password reset routers
Route::get('forgot-password',[PasswordController::class,'get_reset'])->middleware('guest')->name('password.request');
Route::post('forgot-password',[PasswordController::class,'foget_password'])->middleware('guest')->name('password.email');;
Route::get('reset-password/{token}',[PasswordController::class,'get_token'])->middleware('guest')->name('password.reset');
Route::post('reset-password',[PasswordController::class,'form_submit'])->middleware('guest')->name('password.update');;
    


//protected route

Route::group(['middleware'=>['auth:admins']],function(){
    Route::resource('bus', 'BusController');
    Route::resource('bus_routes', 'Bus_routesController');
    Route::resource('bus_seates', 'Bus_seatesController');
    Route::resource('routes', 'RoutesController');

    Route::resource('bus_shedules', 'Bus_schedulesController')->except([
        'index', 'show'
    ]);

    Route::post('logout',[AuthController::class,'logout']);
});




Route::group(['middleware'=>['auth:users']],function(){


    Route::resource('booking', 'BookingController');
    
    Route::post('logout',[AuthController::class,'logout']);

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    

//     Route::resource('bus', 'BusController');
//     Route::resource('bus_routes', 'Bus_routesController');
//     Route::resource('bus_seates', 'Bus_seatesController');
//     Route::resource('routes', 'RoutesController');

//     Route::resource('bus_shedules', 'Bus_schedulesController')->except([
//         'index', 'show'
//     ]);
// });

