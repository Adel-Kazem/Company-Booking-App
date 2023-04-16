<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', function () {
    return redirect()->route('login');
});



Auth::routes(['register' => false]);

Route::get('/admin/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register')->middleware(['checkrole:admin']);
Route::post('/admin/register', [RegisterController::class, 'register'])->middleware(['checkrole:admin']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


//Route::post('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');



Route::prefix('admin')->group(function () {
        Route::get('/create/user', [AdminController::class, 'createUserOfCompanyForm'])->name('admin.create.user.form');
        Route::post('/create/user', [AdminController::class, 'storeUserOfCompany'])->name('admin.create.user.store');
        Route::get('/create/company', [AdminController::class, 'createCompanyForm'])->name('admin.create.company.form');
        Route::post('/create/company', [AdminController::class, 'storeCompany'])->name('admin.create.company.store');
        Route::get('/update/company', [AdminController::class, 'showCompanies'])->name('admin.update.company.show');
        Route::put('/update/company/{id}', [AdminController::class, 'updateCompany'])->name('admin.update.company');
    });


    Route::prefix('company')->group(function () {
        Route::get('/company/edit/user', [CompanyController::class, 'userEditForm'])->name('company.edit.user.form');
        Route::post('/edit/user', [CompanyController::class, 'userEditSubmit'])->name('company.edit.user.submit');

        Route::get('/edit', [CompanyController::class, 'companyEditForm'])->name('company.edit.company.form');
        Route::post('/edit', [CompanyController::class, 'companyEditSubmit'])->name('company.edit.company.submit');

        Route::get('/create/room', [CompanyController::class, 'createRoomForm'])->name('company.create.room.form');
        Route::post('/create/room', [CompanyController::class, 'createRoomSubmit'])->name('company.create.room.submit');
        Route::get('/show/room', [CompanyController::class, 'showRooms'])->name('company.show.rooms');

        Route::get('/room/create/reservation', [CompanyController::class, 'createReservationForm'])->name('company.create.reservation.form');
        Route::post('/room/create/reservation', [CompanyController::class, 'createReservationSubmit'])->name('company.create.reservation.submit');
        Route::get('/show/reservations2', [CompanyController::class, 'showReservations']);
        Route::get('/show/reservations', [CompanyController::class, 'generateCalendarData'])->name('company.show.reservations');
    });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
