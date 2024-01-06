<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\LettersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterTypeController;

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


Route::middleware('IsGuest')->group(function(){
    Route::get('/', function() {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['IsLogin'])->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function() {
        return view('index');
    });
});

Route::middleware(['IsLogin'])->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function() {
        return view('index');
    })->name('dashboard.page');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');


Route::middleware(['IsLogin','IsStaff'])->group(function(){

    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/dashboard/staff', [DashboardController::class, 'index'])->name('home.staff');
    });

Route::prefix('/users')->name('users.')->group(function(){
    Route::get('/staff', [UserController::class, 'indexSt'])->name('staff.home');
    Route::get('/staff/create', [UserController::class, 'createSt'])->name('staff.create');
    Route::post('/store/store', [UserController::class, 'storeSt'])->name('staff.store');
    Route::get('/staff/{id}', [UserController::class, 'editSt'])->name('staff.edit');
    Route::patch('/staff/{id}', [UserController::class, 'updateSt'])->name('staff.update');
    Route::delete('/staff/{id}', [UserController::class, 'destroySt'])->name('staff.delete');

    Route::get('/guru', [UserController::class, 'indexG'])->name('guru.home');
    Route::get('/guru/create', [UserController::class, 'createG'])->name('guru.create');
    Route::post('/guru/store', [UserController::class, 'storeG'])->name('guru.store');
    Route::get('/guru/{id}', [UserController::class, 'editG'])->name('guru.edit');
    Route::patch('/guru/{id}', [UserController::class, 'updateG'])->name('guru.update');
    Route::delete('/guru/{id}', [UserController::class, 'destroyG'])->name('guru.delete');
});

Route::prefix('/klaf')->name('klaf.')->group(function(){
    Route::get('/', [LetterTypeController::class, 'index'])->name('home');
    Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
    Route::get('/show', [LetterTypeController::class, 'show'])->name('show');
    Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
    Route::get('/klaf/{id}/edit', [LetterTypeController::class, 'edit'])->name('edit');
    Route::get('/{id}', [LetterTypeController::class, 'detail'])->name('detail');
    Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
    Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
    Route::get('/download/excel', [LetterTypeController::class, 'excel'])->name('excel');
    Route::get('/download-pdf/{id}', [LetterTypeController::class, 'pdf'])->name('download.pdf');

});

Route::prefix('/letters')->name('letters.')->group(function(){
    Route::get('/', [LettersController::class, 'index'])->name('home.staff');
    Route::get('/create', [LettersController::class, 'create'])->name('create');
    Route::post('/store', [LettersController::class, 'store'])->name('store');
    Route::get('/detail/{id}', [LettersController::class, 'detail'])->name('detail.staff');
    Route::get('/{id}', [LettersController::class, 'edit'])->name('editL');
    Route::patch('/{id}', [LettersController::class, 'update'])->name('update');
    Route::delete('/{id}', [LettersController::class, 'destroy'])->name('delete');
    Route::get('/download/excel', [LettersController::class, 'excel'])->name('excelL');
    Route::get('/exportPdf', [LettersController::class, 'exportPdf'])->name('exportPdf');
});

});

Route::middleware(['IsLogin','IsGuru'])->group(function(){

    Route::prefix('/dashboard')->name('dashboard.')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'countLettersToday'])->name('home');
    });

    Route::prefix('/lettersguru')->name('letters.')->group(function(){
        Route::get('/', [LettersController::class, 'indexG'])->name('home.guru');
        Route::get('/createNotulis/{id}', [ResultController::class, 'create'])->name('create.guru');
        Route::post('/storeguru', [ResultController::class, 'store'])->name('store.guru');
    });

    Route::prefix('/results')->name('results.')->group(function(){
        Route::get('/create/{id}', [ResultController::class, 'create'])->name('create.guru');
        Route::post('/store', [ResultController::class, 'store'])->name('store.guru');
        Route::get('/detail/{id}', [ResultController::class, 'detail'])->name('detail.guru');
        Route::get('/download-pdf', [ResultController::class, 'downloadPdf'])->name('downloadPdf');
    });
});