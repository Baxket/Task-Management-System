<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login_index'])->name('login_index');
    Route::post('/login_post', [AuthController::class, 'authenticate'])->name('login_post');
});

Route::get('/register', [AuthController::class, 'register_page'])->name('register_page');
Route::post('/register', [AuthController::class, 'store'])->name('store');




   
//pages
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function ()
{


    Route::get('/home', [DashboardController::class, 'index'])->name('home');

  
    Route::prefix('projects')->name('projects.')->group(function ()
    {
        Route::get('/manage', [ProjectsController::class, 'index'])->name('manage');
        Route::post('/store', [ProjectsController::class, 'store'])->name('store');

    });

});



