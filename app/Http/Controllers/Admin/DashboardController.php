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
        $goatDistributionChart = DashboardStats::LivestockDistribution();
        $ecdChart = DashboardStats::ecdChart();
        $vslaChart = DashboardStats::groupMemberData();
        $toolkitChart = DashboardStats::toolKit();
        $mvtcChart = DashboardStats::mvtcChart();
        $urgentCommunity = DashboardStats::urgentCommunitySupportChart();
        $fruitsChart = DashboardStats::fruitTrees();
        $trainingChart = DashboardStats::trainingChart();
        $empowermentChart = DashboardStats::ecdEmpowerment();
        $waterTanks = DashboardStats::sanitationStat();

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
            'urgentCommunity' => $urgentCommunity,
            'fruitsChart' => $fruitsChart,
            'trainingChart' => $trainingChart,
            'empowermentChart' => $empowermentChart,
            'waterTanks' => $waterTanks,

        ]);
    }
}
