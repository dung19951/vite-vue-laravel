<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
 */
Route::middleware('api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::group([
        'prefix' => 'v1',
        'namespace' => "App\Http\Controllers",
    ], function () {
        Route::post('auth/register', 'UserController@register');
        Route::post('auth/login', 'UserController@login');
        Route::group(['middleware' => 'jwt.verify'], function () {

        });
    });

});
