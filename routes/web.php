<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GirinkaController;
use App\Http\Controllers\Admin\GoatController;
use App\Http\Controllers\Admin\IndividualController;
use App\Http\Controllers\Admin\MalnutritionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\TankController;
use App\Http\Controllers\Admin\VslaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }

    return redirect()->route('admin.dashboard');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('girinkas', GirinkaController::class)->except(['show']);
    Route::resource('goats', GoatController::class)->except(['show']);
    Route::resource('malnutritions', MalnutritionController::class)->except(['show']);
    Route::resource('tanks', TankController::class)->except(['show']);
    Route::resource('scholarships', ScholarshipController::class)->except(['show']);
    Route::resource('vslas', VslaController::class)->except(['show']);
    Route::resource('individuals', IndividualController::class)->except(['show']);

});

require __DIR__.'/auth.php';
