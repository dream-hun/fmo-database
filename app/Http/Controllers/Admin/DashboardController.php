<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helpers\DashboardStats;
use App\Models\Helpers\TotalNumbers;
use App\Models\Individual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalBeneficiaries = TotalNumbers::getAllCounts();
        $cholarships=TotalNumbers::getScholarships();
        $schoolFeeding=TotalNumbers::getSchoolFeeding();
        $malnutrition=TotalNumbers::getMalnutrition();
        $female = TotalNumbers::femaleBeneficiaries();
        $male = $totalBeneficiaries - $female;
        $chart = DashboardStats::genderDistribution();
        $girinkaChart = DashboardStats::girinkaStats();
        $yearlyLoanPeople = Individual::select(DB::raw('YEAR(loan_date) as year'), DB::raw('COUNT(DISTINCT id) as total_people'))
            ->whereNotNull('loan_date')
            ->groupBy(DB::raw('YEAR(loan_date)'))
            ->orderBy('year', 'asc')
            ->get();

        $labels = $yearlyLoanPeople->pluck('year')->toArray();
        $data = $yearlyLoanPeople->pluck('total_people')->toArray();

        return view('dashboard', [
            'total' => $totalBeneficiaries,
            'female' => $female,
            'male' => $male,
            'beneficiariesChart' => $chart,
            'girinkaChart' => $girinkaChart,
            'labels' => $labels,
            'data' => $data,
            'scholarships' => $cholarships,
            'schoolFeeding' => $schoolFeeding,
            'malnutrition' => $malnutrition,
        ]);
    }
}
