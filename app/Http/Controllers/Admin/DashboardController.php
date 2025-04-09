<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helpers\DashboardStats;
use App\Models\Helpers\TotalNumbers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalBeneficiaries = TotalNumbers::getAllCounts();
        $female = TotalNumbers::femaleBeneficiaries();
        $male = $totalBeneficiaries - $female;
        $chart = DashboardStats::genderDistribution();
        $girinkaChart = DashboardStats::girinkaStats();

        return view('dashboard', [
            'total' => $totalBeneficiaries,
            'female' => $female,
            'male' => $male,
            'beneficiariesChart' => $chart,
            'girinkaChart' => $girinkaChart,
        ]);
    }
}
