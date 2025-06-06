<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helpers\DashboardStats;
use Illuminate\Http\Request;

final class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $girinkaChart = DashboardStats::girinkaStats();
        $individualChart = DashboardStats::individualStats();
        $scholarshipByYear = DashboardStats::yearlyScholarship();
        $malnutritionChart = DashboardStats::malnutritionChart();
        $goatDistributionChart = DashboardStats::goatDistribution();
        $ecdChart = DashboardStats::ecdChart();
        $vslaChart = DashboardStats::vslaLoanData();
        $toolkitChart = DashboardStats::toolkit();
        $mvtcChart = DashboardStats::mvtcChart();
        $support = DashboardStats::supportDistribution();

        return view('dashboard', [

            'individual' => $individualChart,
            'girinkaChart' => $girinkaChart,
            'scholarshipByYear' => $scholarshipByYear,
            'goatDistributionChart' => $goatDistributionChart,
            'ecdChart' => $ecdChart,
            'vslaChart' => $vslaChart,
            'toolkitChart' => $toolkitChart,
            'malnutritionChart' => $malnutritionChart,
            'mvtc' => $mvtcChart,
            'support' => $support,

        ]);
    }
}
