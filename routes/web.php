<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);
    Route::post('users/media', [UserController::class, 'storeMedia'])->name('users.storeMedia');

    // Sport
    Route::resource('sports', SportController::class, ['except' => ['store', 'update', 'destroy']]);

    // Team
    Route::resource('teams', TeamController::class, ['except' => ['store', 'update', 'destroy']]);

    // Country
    Route::resource('countries', CountryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Event
    Route::resource('events', EventController::class, ['except' => ['store', 'update', 'destroy']]);

    // Currency
    Route::resource('currencies', CurrencyController::class, ['except' => ['store', 'update', 'destroy']]);

    // Event
    // Route::resource('announcement', Announcementtroller::class, ['except' => ['store', 'update', 'destroy']]);

    // AnnouncementController



    // Event
    Route::resource('announcements', AnnouncementController::class, ['except' => ['store', 'update', 'destroy']]);
    //Route::get('announcement', [ AnnouncementController::class, 'index'])->name('announcement');
    // Route::get('announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    // Route::post('announcement/store', [AnnouncementController::class, 'store'])->name('announcement.store');
    // Route::get('announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    // Route::post('announcement/{id}/update', [AnnouncementController::class, 'update'])->name('announcement.update');
    // Route::get('announcement/{id}/delete', [AnnouncementController::class, 'delete'])->name('announcement.delete');




});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerController@index');
