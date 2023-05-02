<?php

use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepanController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PengaturanHalamanController;
use App\Http\Controllers\ProfileController;

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


Route::get('/', [DepanController::class, "index"]);

Route::redirect('home', 'dashboard');

Route::get('/auth', [AuthController::class, "index"])->name('login')->middleware('guest');
Route::get('/auth/redirect', [AuthController::class, "redirect"])->middleware('guest');;
Route::get('/auth/callback', [AuthController::class, "callback"])->middleware('guest');
Route::get('/auth/logout', [AuthController::class, "logout"]);


Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::prefix('dashboard')->middleware('auth')->group(
    function () {

        Route::get('/', [HalamanController::class, 'index']);
        Route::resource('halaman', HalamanController::class);
        Route::resource('experience', ExperienceController::class);
        Route::resource('education', EducationController::class);
        Route::get('skill', [SkillController::class, "index"])->name('skill.index');
        Route::post('skill', [SkillController::class, "update"])->name('skill.update');
        Route::get('profile', [ProfileController::class, "index"])->name('profile.index');
        Route::post('profile', [ProfileController::class, "update"])->name('profile.update');
        Route::get('pengaturan', [PengaturanHalamanController::class, "index"])->name('pengaturan.index');
        Route::post('pengaturan', [PengaturanHalamanController::class, "update"])->name('pengaturan.update');
    }
);
