<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreelanceController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/settings', function () {
    return view('admin.blank');
})->name('blank');

Auth::routes();

Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('user.beranda');
Route::get('/category', [App\Http\Controllers\PageController::class, 'categoryView'])->name('user.category');
Route::get('/sign-in', [App\Http\Controllers\PageController::class, 'sign_in'])->name('user.sign-in');
Route::get('/buat-pesanan', [App\Http\Controllers\PageController::class, 'createTransaction'])->name('user.buat.pesanan');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/get/{transaction}', [TransactionController::class, 'getTransaction'])->name('transaction.get');
    Route::put('/transaction/get/{transaction}', [TransactionController::class, 'freelanceTake'])->name('transaction.take');
    Route::get('/transaction-status/ready', [TransactionController::class, 'ready'])->name('transaction.ready');
    Route::get('/transaction-status/on-progress', [TransactionController::class, 'progress'])->name('transaction.progress');
    Route::get('/transaction-status/finish', [TransactionController::class, 'finish'])->name('transaction.finish');
    Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/log-off', [App\Http\Controllers\PageController::class, 'logout_user'])->name('user.logout');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::resource('transaction', TransactionController::class,['except'=>['store']]);
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
    Route::post('/add-file/{transaction}', [App\Http\Controllers\TransactionController::class, 'addFile'])->name('transaction.addFile');
    Route::post('/review', [App\Http\Controllers\TransactionController::class, 'review'])->name('transaction.review');
    Route::delete('delete-file/{transactionFile}',[TransactionController::class,'deleteFile'])->name('file.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/transaction-status/pending', [TransactionController::class, 'pending'])->name('transaction.pending');
    Route::put('/transaction/{transaction}/confirmation', [TransactionController::class, 'confirmation'])->name('transaction.confirmation');
    Route::resource('freelance', FreelanceController::class);
    Route::resource('customer', CustomerController::class);
    // Route::resource('transaction', TransactionController::class,['only'=>['destroy','edit','create']]);
});

Route::middleware(['user'])->group(function () {
    Route::get('/account', [App\Http\Controllers\PageController::class, 'account'])->name('user.account');
});
