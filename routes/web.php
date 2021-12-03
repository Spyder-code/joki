<?php

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

Route::middleware(['auth', 'admin'])->group(function () {

});

Route::middleware(['user'])->group(function () {
    Route::get('/account', [App\Http\Controllers\PageController::class, 'account'])->name('user.account');
    Route::post('/add-file/{transaction}', [App\Http\Controllers\TransactionController::class, 'addFile'])->name('transaction.addFile');
    Route::post('/review', [App\Http\Controllers\TransactionController::class, 'review'])->name('transaction.review');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('transaction', TransactionController::class,['except'=>['store']]);
    Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/log-off', [App\Http\Controllers\PageController::class, 'logout_user'])->name('user.logout');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
});
