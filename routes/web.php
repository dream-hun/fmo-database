<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EcdController;
use App\Http\Controllers\Admin\EmpowermentController;
use App\Http\Controllers\Admin\FruitController;
use App\Http\Controllers\Admin\GirinkaController;
use App\Http\Controllers\Admin\IndividualController;
use App\Http\Controllers\Admin\LivestockController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\MalnutritionController;
use App\Http\Controllers\Admin\MvtcController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\SchoolFeedingController;
use App\Http\Controllers\Admin\TankController;
use App\Http\Controllers\Admin\ToolKitController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\UrgentController;
use App\Http\Controllers\Admin\ZamukaController;
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

    Route::post('livestocks/parse-csv-import', [LivestockController::class, 'parseCsvImport'])->name('livestocks.parseCsvImport');
    Route::post('livestocks/process-csv-import', [LivestockController::class, 'processCsvImport'])->name('livestocks.processCsvImport');
    Route::resource('livestocks', LivestockController::class);

    Route::post('malnutritions/parse-csv-import', [MalnutritionController::class, 'parseCsvImport'])->name('malnutritions.parseCsvImport');
    Route::post('malnutritions/process-csv-import', [MalnutritionController::class, 'processCsvImport'])->name('malnutritions.processCsvImport');
    Route::resource('malnutritions', MalnutritionController::class)->except(['show']);

    Route::post('tanks/parse-csv-import', [TankController::class, 'parseCsvImport'])->name('tanks.parseCsvImport');
    Route::post('tanks/process-csv-import', [TankController::class, 'processCsvImport'])->name('tanks.processCsvImport');
    Route::resource('tanks', TankController::class)->except(['show']);

    Route::post('individuals/parse-csv-import', [IndividualController::class, 'parseCsvImport'])->name('individuals.parseCsvImport');
    Route::post('individuals/process-csv-import', [IndividualController::class, 'processCsvImport'])->name('individuals.processCsvImport');
    Route::resource('individuals', IndividualController::class);

    Route::post('loans/parse-csv-import', [LoanController::class, 'parseCsvImport'])->name('loans.parseCsvImport');
    Route::post('loans/process-csv-import', [LoanController::class, 'processCsvImport'])->name('loans.processCsvImport');
    Route::resource('loans', LoanController::class);

    Route::post('ecds/parse-csv-import', [EcdController::class, 'parseCsvImport'])->name('ecds.parseCsvImport');
    Route::post('ecds/process-csv-import', [EcdController::class, 'processCsvImport'])->name('ecds.processCsvImport');
    Route::resource('ecds', EcdController::class)->except(['show']);

    Route::post('school-feedings/parse-csv-import', [SchoolFeedingController::class, 'parseCsvImport'])->name('school-feedings.parseCsvImport');
    Route::post('school-feedings/process-csv-import', [SchoolFeedingController::class, 'processCsvImport'])->name('school-feedings.processCsvImport');
    Route::resource('school-feedings', SchoolFeedingController::class)->except(['show']);

    Route::post('fruits/parse-csv-import', [FruitController::class, 'parseCsvImport'])->name('fruits.parseCsvImport');
    Route::post('fruits/process-csv-import', [FruitController::class, 'processCsvImport'])->name('fruits.processCsvImport');
    Route::resource('fruits', FruitController::class)->except(['show']);

    Route::post('scholarships/parse-csv-import', [ScholarshipController::class, 'parseCsvImport'])->name('scholarships.parseCsvImport');
    Route::post('scholarships/process-csv-import', [ScholarshipController::class, 'processCsvImport'])->name('scholarships.processCsvImport');
    Route::resource('scholarships', ScholarshipController::class)->except(['show']);

    Route::post('girinkas/parse-csv-import', [GirinkaController::class, 'parseCsvImport'])->name('girinkas.parseCsvImport');
    Route::post('girinkas/process-csv-import', [GirinkaController::class, 'processCsvImport'])->name('girinkas.processCsvImport');
    Route::resource('girinkas', GirinkaController::class)->except(['show']);

    Route::post('toolkits/parse-csv-import', [ToolKitController::class, 'parseCsvImport'])->name('toolkits.parseCsvImport');
    Route::post('toolkits/process-csv-import', [ToolKitController::class, 'processCsvImport'])->name('toolkits.processCsvImport');
    Route::resource('toolkits', ToolKitController::class);

    Route::post('mvtcs/parse-csv-import', [MvtcController::class, 'parseCsvImport'])->name('mvtcs.parseCsvImport');
    Route::post('mvtcs/process-csv-import', [MvtcController::class, 'processCsvImport'])->name('mvtcs.processCsvImport');
    Route::resource('mvtcs', MvtcController::class)->except(['show']);

    Route::post('trainings/parse-csv-import', [TrainingController::class, 'parseCsvImport'])->name('trainings.parseCsvImport');
    Route::post('trainings/process-csv-import', [TrainingController::class, 'processCsvImport'])->name('trainings.processCsvImport');
    Route::resource('trainings', TrainingController::class)->except(['show']);

    Route::post('urgents/parse-csv-import', [UrgentController::class, 'parseCsvImport'])->name('urgents.parseCsvImport');
    Route::post('urgents/process-csv-import', [UrgentController::class, 'processCsvImport'])->name('urgents.processCsvImport');
    Route::resource('urgents', UrgentController::class)->except(['show']);

    Route::post('empowerments/parse-csv-import', [EmpowermentController::class, 'parseCsvImport'])->name('empowerments.parseCsvImport');
    Route::post('empowerments/process-csv-import', [EmpowermentController::class, 'processCsvImport'])->name('empowerments.processCsvImport');
    Route::resource('empowerments', EmpowermentController::class);

    Route::post('zamukas/parse-csv-import', [ZamukaController::class, 'parseCsvImport'])->name('zamukas.parseCsvImport');
    Route::post('zamukas/process-csv-import', [ZamukaController::class, 'processCsvImport'])->name('zamukas.processCsvImport');
    Route::resource('zamukas', ZamukaController::class);

    Route::post('members/parse-csv-import', [App\Http\Controllers\Admin\MemberController::class, 'parseCsvImport'])->name('members.parseCsvImport');
    Route::post('members/process-csv-import', [App\Http\Controllers\Admin\MemberController::class, 'processCsvImport'])->name('members.processCsvImport');
    Route::resource('members', App\Http\Controllers\Admin\MemberController::class);

    Route::post('transactions/parse-csv-import', [App\Http\Controllers\Admin\TransactionController::class, 'parseCsvImport'])->name('transactions.parseCsvImport');
    Route::post('transactions/process-csv-import', [App\Http\Controllers\Admin\TransactionController::class, 'processCsvImport'])->name('transactions.processCsvImport');
    Route::resource('transactions', App\Http\Controllers\Admin\TransactionController::class);

    Route::post('groups/parse-csv-import', [App\Http\Controllers\Admin\GroupController::class, 'parseCsvImport'])->name('groups.parseCsvImport');
    Route::post('groups/process-csv-import', [App\Http\Controllers\Admin\GroupController::class, 'processCsvImport'])->name('groups.processCsvImport');
    Route::resource('groups', App\Http\Controllers\Admin\GroupController::class);

});

require __DIR__.'/auth.php';
