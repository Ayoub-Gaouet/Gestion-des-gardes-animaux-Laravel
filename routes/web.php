<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Adresse\AdresseController;
use App\Http\Controllers\Auth\Admin\RegisteredUserController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pet\PetController;
use App\Http\Controllers\PetOwner\PetOwnerController;
use App\Http\Controllers\PetSitter\PetSitterController;
use App\Http\Controllers\Review\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__ . '/auth.php';
Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::group(['middleware' => ['verified:client.verification.notice']], function () {
        Route::get('/showClientUser', [PetOwnerController::class, "show"])
            ->name('showClientUser.index');
    });

});
Route::prefix('admin')->group(function () {
    Route::group(['middleware' => ['auth:admin', 'verified:admin.verification.notice']], function () {
        Route::get("/", [AdminDashboardController::class, "index"])->name("home");
        Route::get("/users", [UserController::class, "index"])
            ->name("users.index");
        Route::get('/showUser', [UserController::class, "show"])
            ->name('user.index');
        Route::get('/editPictures', [UserController::class, "editPictures"])
            ->name('pictures.edit');
        Route::put('/updateLogo', [UserController::class, "updateLogo"])
            ->name('logo.update');
        Route::put('/updateBackground', [UserController::class, "updateBackground"])
            ->name('background.update');
        Route::put('/updateProfile', [UserController::class, "updateProfile"])
            ->name('users.updateProfile');
        Route::post('/users', [RegisteredUserController::class, "store"])
            ->name('register');
        Route::put('/users/{user?}', [UserController::class, "update"])
            ->name('users.update');
        Route::put('/usersChangePassword', [UserController::class, "changePasswordAccount"])
            ->name('users.changePasswordAccount');
        Route::get('/users/{user?}', [UserController::class, "desactivateAccount"])
            ->name('users.desactivateAccount');

    //{{--petowner router--}}
        Route::get("/petowners", [PetOwnerController::class, "index"])
            ->name("petowners.index");
        Route::post('/petowner', [PetOwnerController::class, "store"])
            ->name('petowner.store');
        Route::put('/petowners/{petowner?}', [PetOwnerController::class, "update"])
            ->name('petowners.update');
        Route::get('/petowners/{petowner?}', [PetOwnerController::class, "desactivateAccount"])
            ->name('petowners.desactivateAccount');
    //{{--petsitter router--}}
        Route::get("/petsitters", [PetSitterController::class, "index"])
            ->name("petsitters.index");
        Route::post('/petsitter', [PetSitterController::class, "store"])
            ->name('petsitter.store');
        Route::put('/petsitters/{petsitter?}', [PetSitterController::class, "update"])
            ->name('petsitters.update');
        Route::get('/petsitters/{petsitter?}', [PetSitterController::class, "desactivateAccount"])
            ->name('petsitters.desactivateAccount');
    //{{--pet router--}}
        Route::get('/pets', [PetController::class, "index"])
            ->name('pets.index');
        Route::put('/pets/{pet?}', [PetController::class, "update"])
            ->name('pets.update');
        Route::post('/pet', [PetController::class, "store"])
            ->name('pet.store');
        Route::delete('/pets/{pet?}', [PetController::class, "destroy"])
            ->name('pets.destroy');
    //{{--adresse router--}}
        Route::get('/adresses', [AdresseController::class, "index"])
            ->name('adresses.index');
        Route::put('/adresses/{adresse?}', [AdresseController::class, "update"])
            ->name('adresses.update');
        Route::post('/adresse', [AdresseController::class, "store"])
            ->name('adresse.store');
        Route::delete('/adresses/{adresse?}', [AdresseController::class, "destroy"])
            ->name('adresses.destroy');
    //{{--booking router--}}
        Route::get('/bookings', [BookingController::class, "index"])
            ->name('bookings.index');
        Route::put('/bookings/{booking?}', [BookingController::class, "update"])
            ->name('bookings.update');
        Route::post('/booking', [BookingController::class, "store"])
            ->name('booking.store');
        Route::delete('/bookings/{booking?}', [BookingController::class, "destroy"])
            ->name('bookings.destroy');
    //{{--review router--}}
        Route::get('/reviews', [ReviewController::class, "index"])
            ->name('reviews.index');
        Route::put('/reviews/{review?}', [ReviewController::class, "update"])
            ->name('reviews.update');
        Route::post('/review', [ReviewController::class, "store"])
            ->name('review.store');
        Route::delete('/reviews/{review?}', [ReviewController::class, "destroy"])
            ->name('reviews.destroy');
    });
    require __DIR__ . '/authAdmin.php';
});

