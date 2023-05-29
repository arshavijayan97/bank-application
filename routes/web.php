<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\StatementController;

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

Auth::routes();
Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/depositview', [DepositController::class, 'depositview'])->name('depositfrom');
Route::post('/deposit', [DepositController::class, 'deposit'])->name('deposit');
Route::get('/withdrawview', [WithdrawalController::class, 'withdrawalview'])->name('withdrwalfrom');
Route::post('/withdraw', [WithdrawalController::class, 'withdrawAmount'])->name('withdraw');
Route::post('/transfer', [TransferController::class, 'transfer'])->name('transfer');
Route::get('/transfer', [TransferController::class, 'showTransferForm'])->name('transferfrom');
Route::get('/statements', [StatementController::class, 'statements'])->name('statement.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



