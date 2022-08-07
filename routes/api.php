<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\Me\ProfileController;
use App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\Country\CountryController;
use App\Http\Controllers\API\Sport\SportController;
use App\Http\Controllers\API\Currency\CurrenciesController;
use App\Http\Controllers\API\Event\EventController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\Upload\UploadController;
use App\Http\Controllers\Admin\AnnouncementController;

Route::get('user/change-email', [ProfileController::class, 'updateEmail'])->name('change-email');

Route::group(['as' => '.api'], function () {
    Route::post('login', [Auth\LoginController::class, 'login'])->name('login');
    Route::post('login-social', [
        Auth\LoginController::class,
        'socialLogin',
    ])->name('socialLogin');

    // Reset Password
    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::post('email', [
            Auth\ForgotPasswordController::class,
            'sendResetLinkEmail',
        ])->name('sendResetLinkEmail');
        Route::post('check-reset-link', [
            Auth\ResetPasswordController::class,
            'checkResetLink',
        ])->name('check-reset-link');
        Route::post('reset', [
            Auth\ResetPasswordController::class,
            'reset',
        ])->name('reset');
        Route::post('forgot', [
            Auth\ForgotPasswordController::class,
            'sendResetLinkEmail',
        ])->name('sendResetLinkEmail');
        Route::post('check-reset-link', [
            Auth\ResetPasswordController::class,
            'checkResetLink',
        ])->name('check-reset-link');
        Route::post('reset', [
            Auth\ResetPasswordController::class,
            'reset',
        ])->name('reset');
    });

    Route::post('register/check-existing', [
        Auth\RegisterController::class,
        'checkExisting',
    ])->name('check-existing');
    Route::post('register-social', [
        Auth\RegisterController::class,
        'registerSocial',
    ])->name('registerSocial');
    Route::post('register', [Auth\RegisterController::class, 'register'])->name(
        'register'
    );
    Route::post('upload', [UploadController::class, 'upload'])->name('upload');
});

Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [Auth\LogoutController::class, 'logout'])->name(
        'logout'
    );
    // API USER MANAGEMENT
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('check-password', [
            ProfileController::class,
            'checkValidPassword',
        ])->name('check-password');
        Route::delete('{id}', [ProfileController::class, 'destroy'])->name(
            'destroy'
        );
        Route::patch('{id}', [ProfileController::class, 'update'])->name(
            'update'
        );
    });
});

// REQUIRED AUTH
Route::middleware('auth:sanctum')->group(function () {
    // EVENT
    Route::get('event', [EventController::class, 'index'])->name('event');
    Route::get('event/{id}', [EventController::class, 'getDetailEvent'])->name(
        'event.getDetailEvent'
    );
    Route::post('event', [EventController::class, 'store'])->name(
        'event.store'
    );
    Route::put('event/{id}', [EventController::class, 'updateEvent'])->name(
        'event.updateEvent'
    );
    Route::delete('event/{id}', [EventController::class, 'destroy'])->name(
        'event.updateEvent'
    );

    // USER
    Route::get('user/{id}', [UserController::class, 'getDetailUser'])->name(
        'user.getDetailUser'
    );
    Route::get('user-search', [UserController::class, 'searchUser'])->name(
        'user.searchUser'
    );
    Route::get('user', [UserController::class, 'index'])->name('user');
});

// API COUNTRY
Route::controller(CountryController::class)->group(function () {
    Route::get('country', 'getListAllCountry')->name(
        'country.getListAllCountry'
    );
    Route::get('country/{id}', 'getDetailCountry')->name(
        'country.getDetailCountry'
    );
});

// API CURRENCY
Route::controller(CurrenciesController::class)->group(function () {
    Route::get('currency', 'index' );
    Route::get('currency/{id}','show');
});
// API SPORT
Route::controller(SportController::class)->group(function () {
    Route::get('sport', 'getListAllSport')->name('sport.getListAllSport');
    Route::get('sport/{id}', 'getDetailSport')->name('sport.getDetailSport');
});




//Jahidul Islam start
// REQUIRED AUTH
Route::middleware('auth:sanctum')->group(function () {
    // EVENT
    //Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement');
    // Route::get('event/{id}', [AnnouncementController::class, 'getDetailEvent'])->name(
    //     'event.getDetailEvent'
    // );
    // Route::post('event', [AnnouncementController::class, 'store'])->name(
    //     'event.store'
    // );
    // Route::put('event/{id}', [AnnouncementController::class, 'updateEvent'])->name(
    //     'event.updateEvent'
    // );
    // Route::delete('event/{id}', [AnnouncementController::class, 'destroy'])->name(
    //     'event.updateEvent'
    // );

    // // USER
    // Route::get('user/{id}', [UserController::class, 'getDetailUser'])->name(
    //     'user.getDetailUser'
    // );
    // Route::get('user-search', [UserController::class, 'searchUser'])->name(
    //     'user.searchUser'
    // );
    // Route::get('user', [UserController::class, 'index'])->name('user');
});


//jahidul islam end