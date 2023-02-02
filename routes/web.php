<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HospitalController;

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
    Route::get('/tests', [BaseController::class, 'index_test_name'])->name('tests.index');
    Route::get('/doctors', [BaseController::class, 'index_doctor'])->name('doctors.index');
});

Route::get('/dev', [BaseController::class, 'dev']);
