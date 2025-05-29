<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helpers\DashboardStats;
use App\Models\Helpers\TotalNumbers;
use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $totalBeneficiaries = TotalNumbers::getAllCounts();
        $female = TotalNumbers::femaleBeneficiaries();
        $male = TotalNumbers::getMalnutrition();

        $girinkaChart = DashboardStats::girinkaStats();
        $individualChart = DashboardStats::individualStats();
        $scholarshipByYear = DashboardStats::yearlyScholarship();

        $scholarshipOptionChart = DashboardStats::scholarshipByOption();
        $goatDistributionChart = DashboardStats::goatDistribution();
        $ecdChart = DashboardStats::ecdChart();
        $vslaChart = DashboardStats::vslaLoanData();
        $toolkitChart = DashboardStats::toolkit();

        return view('dashboard', [
            'total' => $totalBeneficiaries,
            'female' => $female,
            'male' => $male,
            'individual' => $individualChart,
            'girinkaChart' => $girinkaChart,
            'scholarshipByYear' => $scholarshipByYear,
            'scholarshipOptionChart' => $scholarshipOptionChart,
            'goatDistributionChart' => $goatDistributionChart,
            'ecdChart' => $ecdChart,
            'vslaChart' => $vslaChart,
            'toolkitChart' => $toolkitChart,

        ]);
    }
}
