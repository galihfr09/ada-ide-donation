<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsController;
use App\Models\User;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\DonationNewsController;
use App\Http\Controllers\DonationTransactionsController;

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

Route::middleware(['cors', 'json.response'])->group(function () {
    
    // public
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
    
    // need auth
    Route::middleware('auth:api')->group(function () {
        // our routes to be protected will go in here
        Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
        Route::get('/user', function (Request $request){
            return User::all();
        });
        Route::apiResource('donations', DonationsController::class);
        Route::apiResource('donationNews', DonationNewsController::class);
        Route::apiResource('donationTransactions', DonationTransactionsController::class)->except(['index']);
        Route::post('/donationTransactions/get', [DonationTransactionsController::class, 'get']);
        Route::post('/donationTransactions/claim', [DonationTransactionsController::class, 'claim']);
        Route::post('/donationTransactions/expire', [DonationTransactionsController::class, 'expire']);
    });
});

Route::fallback(function(){
    return response()->json(['message' => 'Route not Found.'], 404);
});