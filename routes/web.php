<?php

use App\Http\Controllers\Admin\EntryController as AdminEntryController;
use \App\Http\Controllers\EntryController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntryController::class, 'index'])->name('entry.index');

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function() {
    Route::get('/entry/{entry}', [EntryController::class, 'ajaxView'])->name('entry.view');
    Route::get('/exchange', [EntryController::class, 'ajaxExchange'])->name('exchange');
});

/**
 * Login and Registration
 */

Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/**
 * Email verification
 */

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('admin.entry.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

/**
 * Admin
 */

Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('/entry', AdminEntryController::class);
});

