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
        $cholarships = TotalNumbers::getScholarships();
        $schoolFeeding = TotalNumbers::getSchoolFeeding();
        $malnutrition = TotalNumbers::getMalnutrition();
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

        // Scholarship beneficiaries per year only (for chart)
        $scholarshipByYear = \App\Models\Scholarship::selectRaw('entrance_year as year, COUNT(*) as beneficiaries')
            ->groupBy('entrance_year')
            ->orderBy('entrance_year')
            ->get();
        $scholarshipYears = $scholarshipByYear->pluck('year');
        $scholarshipCounts = $scholarshipByYear->pluck('beneficiaries');

        // Aggregate VSLA count per year (using created_at year)
        $vslaByYear = \App\Models\Vsla::selectRaw('YEAR(created_at) as year, COUNT(*) as vsla_count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Merge years from both datasets
        $years = collect($scholarshipByYear->pluck('year'))
            ->merge($vslaByYear->pluck('year'))
            ->unique()
            ->sort()
            ->values();

        // Prepare data arrays for chart
        $beneficiaries = $years->map(fn ($year) => (int) ($scholarshipByYear->firstWhere('year', $year)?->beneficiaries ?? 0));

        // Study option vs number of students
        $studyOptionData = \App\Models\Scholarship::selectRaw('study_option, COUNT(*) as count')
            ->groupBy('study_option')
            ->orderBy('count', 'desc')
            ->get();
        $studyOptionLabels = $studyOptionData->pluck('study_option');
        $studyOptionCounts = $studyOptionData->pluck('count');

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
            'years' => $years,
            'beneficiariesPerYear' => $beneficiaries,

            'scholarshipYears' => $scholarshipYears,
            'scholarshipCounts' => $scholarshipCounts,
            'studyOptionLabels' => $studyOptionLabels,
            'studyOptionCounts' => $studyOptionCounts,
        ]);
    }
}
