<?php

use App\Http\Controllers\ProfileController;
use App\Models\Hospital;
use App\Models\Test;
use App\Models\TestName;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/test/{id}', function ($id) {
    // $user = User::findorFail($id);
    // return $user->role;
    //return $user->hospital;
    // return  $user->tests;

    // $hospital = Hospital::findOrFail($id);
    // return $hospital->user;
    //return $hospital->tests;
    // return $hospital->doctors;

    // $test = Test::findOrFail($id);
    // return $test->hospital;
    // return $test->user;
    //return $test->testName;

    // $test_name = TestName::findOrFail($id);
    // return $test_name->hospitals;
    // return $test_name->tests;

    // $doctor = Doctor::findOrFail($id);
    // return $doctor->hospitals;
})->name('test');
