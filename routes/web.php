<?php

use App\Models\Country;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\SavedEventController;
use App\Http\Controllers\SaveSystemController;
use App\Http\Controllers\GalleryIndexController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\SavedEventSystemController;
use App\Models\SavedEvent;

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

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

Route::get('/dashboard', [DashboardController::class, 'tampilData'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/saved-events/get-detail/{id}', [SavedEventSystemController::class, 'tampilData']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/events', EventController::class);
    Route::resource('/galleries', GalleryController::class);

    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/saved-events', SavedEventController::class)->name('savedEvents');
    Route::get('/attending-events', AttendingEventController::class)->name('attendingEvents');

    Route::post(
        '/events-like/{id}',
        LikeSystemController::class
    )->name('events.like');

    Route::post(
        '/events-saved/{id}',
        SavedEventSystemController::class
    )->name('events.saved');


    Route::get('/event/muncul/{id}', SavedEventSystemController::class, 'muncul')->name('event.muncul');

    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events-like/{id}', LikeSystemController::class)->name('events.like');
    Route::post('/events-save/{id}', SaveSystemController::class)->name('events.save');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');

    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

    // Route ini untuk mendapatkan negara di seluruh dan melewati ID
    // Jadi dia akan menjadi ID dan kemudian kita menggunakan penutupan melewati model negara di sekitar model yang mengikat negara dan hanya mengembalikan respon kota negara Json
    Route::get('/countries/{country}', function (Country $country) {
        return response()->json($country->cities);
    });

});

require __DIR__.'/auth.php';
