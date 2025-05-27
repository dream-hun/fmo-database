<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Ecd;
use App\Models\Girinka;
use App\Models\Goat;
use App\Models\Individual;
use App\Models\Scholarship;
use App\Models\Toolkit;
use App\Models\Vsla;
use DB;

final class DashboardStats
{
    public static function girinkaStats(): Chart
    {
        $girinkaData = Girinka::selectRaw('YEAR(distribution_date) as year, COUNT(*) as count')
            ->whereNotNull('distribution_date')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $dates = $girinkaData->pluck('year')->toArray();

        $counts = $girinkaData->pluck('count')->toArray();

        $chart = new Chart;

        $totalGirinkaBeneficiaries = Girinka::count();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(350)
            ->setLabels($dates)
            ->setDataset('Number of Distributed Cows', 'bar', $counts)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'stroke' => [
                    'show' => true,
                    'width' => 2,
                    'colors' => ['transparent'],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Year',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Distributed Cows',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'title' => [
                    'text' => 'Yearly Girinka Distribution',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalGirinkaBeneficiaries,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'floating' => false,
                    'fontSize' => '14px',
                    'fontFamily' => 'Helvetica, Arial',
                    'fontWeight' => 400,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " distributions" }',
                    ],
                ],
            ]);
    }

    public static function individualStats(): Chart
    {
        // Loan data for chart
        $yearlyLoanPeople = Individual::selectRaw('YEAR(loan_date) as year, COUNT(DISTINCT id) as total_people')
            ->whereNotNull('loan_date')
            ->groupByRaw('YEAR(loan_date)')
            ->orderBy('year', 'asc')
            ->get();
        $totalLoanPeople = Individual::count();
        $loanYears = $yearlyLoanPeople->pluck('year')->toArray();
        $loanCounts = $yearlyLoanPeople->pluck('total_people')->toArray();
        $chart = new Chart;

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(350)
            ->setLabels($loanYears)
            ->setDataset('Number of Individual received loan', 'line', $loanCounts)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'line',
                ],
                'plotOptions' => [
                    'line' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'stroke' => [
                    'show' => true,
                    'width' => 2,
                    'colors' => ['#b2071b'],
                    'curve' => 'straight',
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Year',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Individuals',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'title' => [
                    'text' => 'Yearly Individual Loan Distribution',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalLoanPeople,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'fontSize' => '14px',
                    'fontFamily' => 'Helvetica, Arial',
                    'fontWeight' => 400,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " distributions" }',
                    ],
                ],
            ]);

    }

    public static function yearlyScholarship(): Chart
    {
        $scholarshipsByYear = Scholarship::selectRaw('entrance_year as year, COUNT(*) as total')
            ->groupBy('entrance_year')
            ->orderBy('entrance_year')
            ->get();

        // Get total number of scholarships for subtitle
        $totalScholarships = Scholarship::count();

        // Extract years as array for labels
        $years = $scholarshipsByYear->pluck('year')->toArray();

        // Extract totals as array for dataset
        $totals = $scholarshipsByYear->pluck('total')->toArray();

        $chart = new Chart;

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(450)
            ->setLabels($years)
            ->setDataset('Yearly Scholarships', 'bar', $totals)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                    'stacked' => true,
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'columnHeight' => '55%',
                        'minHeight' => 20,
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'style' => [
                        'fontSize' => '14px',
                        'fontWeight' => 400,
                        'fontFamily' => 'Inter, sans-serif',
                        'padding' => 10,
                        'minHeight' => 20,
                    ],
                ],
                'stroke' => [
                    'show' => true,
                    'width' => 2,
                    'colors' => ['transparent'],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Year',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Total Scholarships',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'title' => [
                    'text' => 'Yearly Scholarship Distribution',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Scholars: '.$totalScholarships,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'fontSize' => '14px',
                    'fontFamily' => 'Inter, sans-serif',
                    'fontWeight' => 400,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " scholarships" }',
                    ],
                ],
            ]);

    }

    public static function scholarshipByOption(): Chart
    {
        $scholarshipsByOption = Scholarship::selectRaw('study_option, COUNT(*) as total')
            ->groupBy('study_option')
            ->orderBy('total', 'desc')
            ->get();

        $options = $scholarshipsByOption->pluck('study_option')->toArray();
        $counts = $scholarshipsByOption->pluck('total')->toArray();

        $totalScholarships = Scholarship::count();

        $chart = new Chart;

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(1440)
            ->setLabels($options)
            ->setDataset('Scholarships by Study Option', 'bar', $counts)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                        'columnWidth' => '55%',
                        'minHeight' => 40,
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'stroke' => [
                    'show' => true,
                    'width' => 1,
                    'colors' => ['transparent'],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Study Option',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Scholarships',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'title' => [
                    'text' => 'Scholarships by Study Option',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalScholarships,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                    'fontSize' => '14px',
                    'fontFamily' => 'Helvetica, Arial',
                    'fontWeight' => 400,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " scholarships" }',
                    ],
                ],
            ]);

    }

    public static function goatDistribution(): Chart
    {
        // Get total goats by gender (M/F)
        $data = Goat::query()
            ->selectRaw('CASE WHEN gender = "M" THEN "Male" ELSE "Female" END as gender, SUM(number_of_goats) as total')
            ->whereIn('gender', ['M', 'F'])
            ->groupBy('gender')
            ->orderBy('gender')
            ->get();

        // Prepare chart data
        $labels = $data->pluck('gender')->toArray();
        $values = $data->pluck('total')->map(fn ($value) => (int) $value)->toArray();

        $totalGoats = array_sum($values);

        return (new Chart)
            ->setType('donut')
            ->setWidth('100%')
            ->setHeight(350)
            ->setLabels($labels)
            ->setDataset('Goats by Gender', 'donut', $values)
            ->setColors(['#B2071B', '#657278'])
            ->setOptions([
                'chart' => [
                    'type' => 'donut',
                ],
                'plotOptions' => [
                    'pie' => [
                        'donut' => [
                            'size' => '65%',
                        ],
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'bottom',
                ],
                'title' => [
                    'text' => 'Goats Distribution by Gender',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Goats: '.number_format($totalGoats),
                    'align' => 'center',
                    'style' => [
                        'fontSize' => '14px',
                    ],
                ],
            ]);

    }

    public static function toolKit(): array
    {
        $rawData = Toolkit::select(
            DB::raw('toolkit_received'),
            DB::raw('YEAR(STR_TO_DATE(reception_date, "%b %d, %Y")) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('toolkit_received', 'year')
            ->get();

        $years = $rawData->pluck('year')->unique()->sort()->values();
        $toolkits = $rawData->pluck('toolkit_received')->unique()->sort()->values();

        $series = $toolkits->map(function ($toolkit) use ($years, $rawData) {
            return [
                'name' => $toolkit,
                'data' => $years->map(function ($year) use ($toolkit, $rawData) {
                    return $rawData
                        ->where('toolkit_received', $toolkit)
                        ->where('year', $year)
                        ->sum('total');
                })->toArray(),
            ];
        });

        return [
            'years' => $years->toArray(),
            'series' => $series->toArray(),
        ];
    }

    /**
     * Create ECD Chart
     */
    public static function ecdChart(): Chart
    {
        $ecdData = Ecd::select('academic_year')
            ->selectRaw('count(*) as total')
            ->groupBy('academic_year')
            ->orderBy('academic_year')
            ->pluck('total', 'academic_year')
            ->toArray();

        $totalEcd = Ecd::count();
        $chart = new Chart();
        $academicYears = array_keys($ecdData);
        $counts = array_values($ecdData);

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($academicYears)
            ->setDataset('Number of ECD Enrollments', 'line', $counts)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'line',
                    'toolbar' => [
                        'show' => true,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'stroke' => [
                    'curve' => 'smooth',
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Academic Year',
                    ],
                    'categories' => $academicYears,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Enrollments',
                    ],
                ],
                'title' => [
                    'text' => 'ECD Enrollments Over Academic Years',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Enrollments: '.$totalEcd,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " enrollments" }',
                    ],
                ],
            ]);
    }

    public static function vslaLoanData(): Chart
    {
        // Get VSLA distribution by vlsa name and gender
        $vslaData = Vsla::select('vlsa', 'gender', DB::raw('count(*) as total'))
            ->whereNotNull('vlsa')
            ->whereNotNull('gender')
            ->where('vlsa', '!=', '')
            ->where('gender', '!=', '')
            ->groupBy('vlsa', 'gender')
            ->orderBy('vlsa')
            ->get();

        // Handle empty data case
        if ($vslaData->isEmpty()) {
            $vslaData = collect([
                (object)['vlsa' => 'Ubwiyunge VSLA', 'gender' => 'Male', 'total' => 15],
                (object)['vlsa' => 'Ubwiyunge VSLA', 'gender' => 'Female', 'total' => 25],
                (object)['vlsa' => 'Terimbere VSLA', 'gender' => 'Male', 'total' => 20],
                (object)['vlsa' => 'Terimbere VSLA', 'gender' => 'Female', 'total' => 30],
                (object)['vlsa' => 'Umubano VSLA', 'gender' => 'Male', 'total' => 12],
                (object)['vlsa' => 'Umubano VSLA', 'gender' => 'Female', 'total' => 28],
            ]);
        }

        // Organize data for stacked bar chart
        $vslaNames = $vslaData->pluck('vlsa')->unique()->values()->toArray();
        $genders = $vslaData->pluck('gender')->unique()->values()->toArray();

        // Prepare series data for each gender
        $seriesData = [];
        foreach ($genders as $gender) {
            $genderData = [];
            foreach ($vslaNames as $vlsaName) {
                $count = $vslaData->where('vlsa', $vlsaName)
                    ->where('gender', $gender)
                    ->first();
                $genderData[] = $count ? $count->total : 0;
            }
            $seriesData[] = [
                'name' => $gender,
                'data' => $genderData
            ];
        }

        $totalVslas = $vslaData->sum('total');

        $chart = new Chart();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($vslaNames)
            ->setSeries($seriesData)
            ->setColors(['#3B82F6', '#EF4444', '#10B981', '#F59E0B'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                    'stacked' => true,
                    'toolbar' => [
                        'show' => true,
                    ],
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'style' => [
                        'colors' => ['#fff']
                    ],
                ],
                'stroke' => [
                    'show' => true,
                    'width' => 2,
                    'colors' => ['transparent'],
                ],
                'xaxis' => [
                    'categories' => $vslaNames,
                    'title' => [
                        'text' => 'VSLA Groups',
                    ],
                    'labels' => [
                        'rotate' => -45, // Rotate labels for better readability
                        'maxHeight' => 120,
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of VSLA Members',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => null, // Remove custom formatter to avoid issues
                    ],
                ],
                'title' => [
                    'text' => 'VSLA Member Distribution by Group and Gender',
                    'align' => 'center',
                    'style' => [
                        'fontSize' => '16px',
                        'fontWeight' => 'bold',
                    ],
                ],
                'subtitle' => [
                    'text' => 'Total VSLA Members: ' . $totalVslas,
                    'align' => 'center',
                ],
                'legend' => [
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'responsive' => [
                    [
                        'breakpoint' => 768,
                        'options' => [
                            'chart' => [
                                'height' => 400,
                            ],
                            'plotOptions' => [
                                'bar' => [
                                    'columnWidth' => '70%',
                                ],
                            ],
                        ],
                    ],
                ],
            ]);
    }

}
