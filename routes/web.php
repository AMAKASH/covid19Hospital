<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NoticeController;
use App\Models\Hospital;

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
    Route::get('/contact-us', [BaseController::class, 'contact_us'])->name('contact-us');
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
    Route::get('vaccine_register/{hospital}', [BaseController::class, 'reg_vaccine'])->name('register_vaccine');
    Route::get('vaccine_unregister', [BaseController::class, 'unreg_vaccine'])->name('unregister_vaccine');
    Route::post('update_vac', [BaseController::class, 'update_vaccine_info'])->name('update_vac');
    Route::post('notify_vac', [HospitalController::class, 'sendVacReminder'])->name('notify_vac');

    Route::patch('/hospital/{hospital}', [HospitalController::class, 'update'])->name('hospital.update');
    Route::patch('/hospital/{hospital}/test_doctor', [HospitalController::class, 'update_test_doctor'])
        ->name('hospital.update_test_doctor');
    Route::patch('/update-test-cost/{test_name}', [BaseController::class, 'update_test_cost'])
        ->name('update-test-cost');
    Route::patch('/update-doctor-fees/{doctor}', [BaseController::class, 'update_doctor_fees'])
        ->name('update-doctor-fees');
    Route::post('/hospital/store/{user}', [HospitalController::class, 'store'])->name('hospital.store');
    Route::get('hospital/approve/{hospital}', [BaseController::class, 'approve_hospital'])->name('hospital.approve');
    Route::get('hospital/reject/{hospital}', [BaseController::class, 'reject_hospital'])->name('hospital.reject');

    Route::get('/test/{test}/edit', [TestController::class, 'edit'])->name('test.edit');
    Route::patch('/test/{test}', [TestController::class, 'update'])->name('test.update');
    Route::get('/test/{test}/download', [TestController::class, 'download'])->name('test.download');

    Route::get('/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::patch('/appointment/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');

    Route::post('/dev', [BaseController::class, 'dev'])->name('admin.dev');

    Route::delete('notices/{hospital}/{notice}', [NoticeController::class, 'destroy'])->name('hospital.notice.destroy');
    Route::post('notices/{hospital}', [NoticeController::class, 'store'])->name('notice.create');
    Route::get('reminder/{hospital}/{user}', [HospitalController::class, 'sendReminder'])->name('vaccine.reminder');
});
