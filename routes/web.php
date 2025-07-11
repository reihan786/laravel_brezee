<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->id_level === 1) {
        return view('admin.dashboard');
    }elseif (Auth::user()->id_level === 2) {
        return view('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google',[HomeController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[HomeController::class, 'callbackGoogle']);

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    //middleware untuk bagian Admin
    route::get('admin/dashboard', [HomeController::class,'indexAdmin']);
});

Route::middleware(['auth'])->group(function(){
   ////middleware untuk bagian User
    route::get('user/dashboard', [HomeController::class,'indexUser']);
});
