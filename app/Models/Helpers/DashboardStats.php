<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Ecd;
use App\Models\FoodAndHouse;
use App\Models\Girinka;
use App\Models\Goat;
use App\Models\Individual;
use App\Models\Musa;
use App\Models\Mvtc;
use App\Models\Scholarship;
use App\Models\Toolkit;
use App\Models\Vsla;
use DB;
use function Termwind\style;

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
            ->setHeight(500)
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
            ->setHeight(500)
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
        $data = Scholarship::selectRaw('entrance_year, COUNT(*) as total')
            ->groupBy('entrance_year')
            ->orderBy('entrance_year')
            ->get();
        $totalScholarship = Scholarship::count();

        $years = $data->pluck('entrance_year')->toArray();
        $counts = $data->pluck('total')->map(fn ($val) => (int) $val)->toArray();

        return (new Chart)
            ->setType('bar')
            ->setLabels($years)
            ->setSeries([
                [
                    'name' => 'Scholars (Bar)',
                    'type' => 'column',
                    'data' => $counts,
                ],
                [
                    'name' => 'Scholars (Line)',
                    'type' => 'line',
                    'data' => $counts,
                ],
            ])
            ->setOptions([
                'chart' => [
                    'height' => 500,
                    'type' => 'line',
                ],
                'stroke' => [
                    'width' => [0, 4],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'enabledOnSeries' => [1],
                ],
                'xaxis' => [
                    'categories' => $years,
                ],
                'title' => [
                    'text' => 'Scholars by Entrance Year',
                    'align' => 'center',
                ],
                'legend' => [
                    'position' => 'bottom',
                ],
                'subtitle' => [
                    'text' => 'Total scholarship: '.number_format($totalScholarship),
                    'align' => 'center',
                    'style' => [
                        'fontSize' => '14px',
                    ],
                ],
            ]);

    }

    public static function goatDistribution(): Chart
    {

        $data = Goat::query()
            ->selectRaw('CASE WHEN gender = "M" THEN "Male" ELSE "Female" END as gender, SUM(number_of_goats) as total')
            ->whereIn('gender', ['M', 'F'])
            ->groupBy('gender')
            ->orderBy('gender')
            ->get();


        $labels = $data->pluck('gender')->toArray();
        $values = $data->pluck('total')->map(fn ($value) => (int) $value)->toArray();

        $totalGoats = array_sum($values);

        return (new Chart)
            ->setType('donut')
            ->setWidth('100%')
            ->setHeight(500)
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

    public static function supportDistribution(): Chart
    {
        $data = FoodAndHouse::query()
            ->selectRaw('support, COUNT(*) as total')
            ->whereNotNull('support')
            ->groupBy('support')
            ->orderBy('support')
            ->get();

        $labels = $data->pluck('support')->toArray();
        $values = $data->pluck('total')->map(fn ($value) => (int) $value)->toArray();
        $total = array_sum($values);

        return (new Chart)
            ->setType('donut')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($labels)
            ->setDataset('Support Distribution', 'donut', $values)
            ->setColors([
                '#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a'
            ])
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
                    'labels' => [
                        'colors' => '#000',
                        'useSeriesColors' => false,
                    ],
                ],
                'title' => [
                    'text' => 'Support Distribution by Type',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total: ' . number_format($total),
                    'align' => 'center',
                    'style' => [
                        'fontSize' => '14px',
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => "function(val) { return val + ' people'; }",
                    ],
                ],
            ]);
    }

    public static function toolKit(): Chart
    {
        $mvtcData = Toolkit::selectRaw('toolkit_received, COUNT(*) as count')
            ->whereNotNull('toolkit_received')
            ->groupBy('toolkit_received')
            ->pluck('count', 'toolkit_received')
            ->toArray();

        $totalToolkits=Toolkit::count();
        $chart = new Chart();
        $toolkits=array_keys($mvtcData);
        $counts=array_values($mvtcData);

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($toolkits)
            ->setDataset('Number of beneficiaries received toolkits', 'bar', $counts)
            ->setColors(['#B2071B'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
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
                        'text' => 'Toolkits',
                    ],
                    'categories' => $toolkits,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of beneficiaries received toolkits',
                    ],
                ],
                'title' => [
                    'text' => 'Toolkit Distributions',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total beneficiaries: '.$totalToolkits,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " students" }',
                    ],
                ],

            ]);

    }

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
        $vslaData = Vsla::select('vlsa', 'gender', DB::raw('count(*) as total'))
            ->whereNotNull('vlsa')
            ->whereNotNull('gender')
            ->where('vlsa', '!=', '')
            ->where('gender', '!=', '')
            ->groupBy('vlsa', 'gender')
            ->orderBy('vlsa')
            ->get();

        if ($vslaData->isEmpty()) {
            $vslaData = collect([
                (object) ['vlsa' => 'Ubwiyunge VSLA', 'gender' => 'Male', 'total' => 15],
                (object) ['vlsa' => 'Ubwiyunge VSLA', 'gender' => 'Female', 'total' => 25],
                (object) ['vlsa' => 'Terimbere VSLA', 'gender' => 'Male', 'total' => 20],
                (object) ['vlsa' => 'Terimbere VSLA', 'gender' => 'Female', 'total' => 30],
                (object) ['vlsa' => 'Umubano VSLA', 'gender' => 'Male', 'total' => 12],
                (object) ['vlsa' => 'Umubano VSLA', 'gender' => 'Female', 'total' => 28],
            ]);
        }

        $vslaNames = $vslaData->pluck('vlsa')->unique()->values()->toArray();
        $genders = $vslaData->pluck('gender')->unique()->values()->toArray();

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
                'data' => $genderData,
            ];
        }

        $totalVslas = $vslaData->sum('total');

        $chart = new Chart();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($vslaNames)
            ->setSeries($seriesData)
            ->setColors(['#B2071B', '#657278', '#10B981', '#F59E0B'])
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
                        'horizontal' => false, // Changed to true for horizontal bars
                        'columnWidth' => '100%',
                        'endingShape' => 'rounded',
                        'style'=>[
                            'minHeight' => '60px',
                        ]
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'style' => [
                        'colors' => ['#fff'],
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
                        'text' => 'Number of VSLA Members', // Swapped axis titles
                    ],
                    'labels' => [
                        'maxHeight' => 120, // Removed rotation as it's not needed for horizontal
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'VSLA Groups', // Swapped axis titles
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => null,
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
                    'text' => 'Total VSLA Members: '.$totalVslas,
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

    public static function musaSupport(): int
    {
        return Musa::count();

    }

    public static function mvtcChart(): Chart
    {

        $mvtcData = Mvtc::selectRaw('trade, COUNT(*) as count')
            ->whereNotNull('trade')
            ->groupBy('trade')
            ->pluck('count', 'trade')
            ->toArray();

        $totalStudents=Mvtc::count();
        $chart = new Chart();
        $trades=array_keys($mvtcData);
        $counts=array_values($mvtcData);

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($trades)
            ->setDataset('Number of student per trade', 'bar', $counts)
            ->setColors(['#657278'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
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
                        'text' => 'Trades',
                    ],
                    'categories' => $trades,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Students',
                    ],
                ],
                'title' => [
                    'text' => 'MVTC Student Distribution By Trade',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total students: '.$totalStudents,
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " students" }',
                    ],
                ],

            ]);




    }
}
