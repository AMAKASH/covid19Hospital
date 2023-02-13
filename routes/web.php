<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

require __DIR__ . '/auth.php';

Route::middleware('web')->group(function () {
    Route::get('/', [BaseController::class, 'index'])->name('landing');
    Route::post('/search', [HospitalController::class, 'search'])->name('hospital.search');
    Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospital.index');
    Route::get('/hospital/{hospital}', [HospitalController::class, 'show'])->name('hospital.show');
    Route::get('/tests', [BaseController::class, 'index_test_name'])->name('test.index');
    Route::get('/doctors', [BaseController::class, 'index_doctor'])->name('doctor.index');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/test/create/{hospital}', [TestController::class, 'create'])->name('test.create');
    Route::post('/test/store', [TestController::class, 'store'])->name('test.store');

    Route::get('/appointment/create/{hospital}', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');

    Route::get('/dashboard', [BaseController::class, 'render_dashboard'])->name('dashboard');
    Route::patch('/user', [BaseController::class, 'user_update'])->name('user.update');
    Route::patch('/user/password', [BaseController::class, 'user_password_update'])->name('user.update.password');

    Route::patch('/hospital/{hospital}', [HospitalController::class, 'update'])->name('hospital.update');
    Route::patch('/hospital/{hospital}/test_doctor', [HospitalController::class, 'update_test_doctor'])
        ->name('hospital.update_test_doctor');
    Route::post('/hospital/store/{user}', [HospitalController::class, 'store'])->name('hospital.store');

    Route::get('/test/{test}/edit', [TestController::class, 'edit'])->name('test.edit');
    Route::patch('/test/{test}', [TestController::class, 'update'])->name('test.update');
    Route::get('/test/{test}/download', [TestController::class, 'download'])->name('test.download');

    Route::get('/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::patch('/appointment/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');

    Route::post('/dev', [BaseController::class, 'dev'])->name('admin.dev');
});
