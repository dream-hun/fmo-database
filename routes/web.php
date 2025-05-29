<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EcdController;
use App\Http\Controllers\Admin\FruitController;
use App\Http\Controllers\Admin\GirinkaController;
use App\Http\Controllers\Admin\GoatController;
use App\Http\Controllers\Admin\IndividualController;
use App\Http\Controllers\Admin\MalnutritionController;
use App\Http\Controllers\Admin\MusaController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\SchoolFeedingController;
use App\Http\Controllers\Admin\TankController;
use App\Http\Controllers\Admin\ToolKitController;
use App\Http\Controllers\Admin\VslaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }

    return redirect()->route('admin.dashboard');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('girinkas', GirinkaController::class)->except(['show']);
    Route::post('girinkas/import', [GirinkaController::class, 'import'])->name('girinkas.import');
    Route::resource('goats', GoatController::class)->except(['show']);
    Route::resource('malnutritions', MalnutritionController::class)->except(['show']);
    Route::resource('tanks', TankController::class)->except(['show']);
    Route::resource('scholarships', ScholarshipController::class)->except(['show']);
    Route::post('scholarships/import', [ScholarshipController::class, 'import'])->name('scholarships.import');
    Route::resource('vslas', VslaController::class)->except(['show']);
    Route::resource('individuals', IndividualController::class)->except(['show']);
    Route::resource('school-feedings', SchoolFeedingController::class)->except(['show']);
    Route::resource('fruits', FruitController::class)->except(['show']);
    Route::resource('toolkits', ToolKitController::class)->except(['show']);
    Route::post('toolkits/import', [ToolKitController::class, 'importData'])->name('toolkits.import');
    Route::resource('ecds', EcdController::class)->except(['show']);
    Route::resource('musas', MusaController::class)->except(['show']);
    Route::post('musas/parse-csv-import', [MusaController::class, 'parseCsvImport'])->name('musas.parseCsvImport');
    Route::post('musas/process-csv-import', [MusaController::class, 'processCsvImport'])->name('musas.processCsvImport');

});

require __DIR__.'/auth.php';
