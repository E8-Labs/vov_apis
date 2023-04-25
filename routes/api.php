<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Listing\StaticListingController;
use App\Http\Controllers\Listing\UserListingController;
use App\Http\Controllers\Listing\PostInteractionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('signup', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);

Route::post('check_email_availablity', [UserAuthController::class, 'checkEmailAvailablity']);
Route::post('check_phone_availablity', [UserAuthController::class, 'checkPhoneAvailablity']);
Route::post('check_username_availablity', [UserAuthController::class, 'checkUsernameAvailablity']);

Route::post('send_test_email', [UserAuthController::class, 'sendTestEmail']);
Route::post('send_code', [UserAuthController::class, 'sendVerificationMail']);
Route::post('verify_email', [UserAuthController::class, 'confirmVerificationCode']);

Route::get("genres_list",[StaticListingController::class,'listGenres']);
Route::get("artists_list",[StaticListingController::class,'listArtists']);


Route::group([

    'middleware' => 'api',
    'prefix' => ''

], function ($router) {
	Route::get("me",[UserAuthController::class,'getMyProfile']);
	Route::get("profile",[UserAuthController::class,'getOtherUserProfile']);

	// //Song
	Route::post("add_listing",[UserListingController::class,'addListing']);
	Route::get("list_items",[UserListingController::class,'getListings']);
	

    Route::post('like_post', [PostInteractionController::class, 'likePost']);
    Route::post('comment_on_post', [PostInteractionController::class, 'commentOnPost']);
 //    Route::post('logout', 'Auth\UserAuthController@logout');
 //    Route::post('refresh', 'Auth\UserAuthController@refresh');
 //    Route::post('me', 'Auth\UserAuthController@me');

});
