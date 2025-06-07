<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Ecd;
use App\Models\Girinka;
use App\Models\Goat;
use App\Models\Individual;
use App\Models\Malnutrition;
use App\Models\Mvtc;
use App\Models\Scholarship;
use App\Models\Toolkit;
use App\Models\Urgent;
use App\Models\Vsla;
use DB;

final class DashboardStats
{
    public static function malnutritionChart(): Chart
    {
        $beneficiaries = Malnutrition::select(
            DB::raw('YEAR(package_reception_date) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->pluck('total', 'year')
            ->toArray();

        $children = Malnutrition::count();
        $years = array_keys($beneficiaries);
        $totalBeneficiaries = array_values($beneficiaries);
        $totalChildren = array_sum($totalBeneficiaries);

        $chart = new Chart();

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($years)
            ->setDataset('Children', 'line', $totalBeneficiaries)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'line',
                    'toolbar' => ['show' => true],
                    'zoom' => ['enabled' => true],
                ],
                'title' => [
                    'text' => 'Malnutrition children distribution',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total children: '.$children,
                    'align' => 'left',
                ],
                'xaxis' => [
                    'categories' => $years,
                    'title' => ['text' => 'Years'],
                ],
                'yaxis' => [
                    'title' => ['text' => 'Number of children'],
                ],
                'stroke' => [
                    'curve' => 'smooth',
                    'width' => 3,
                ],
                'markers' => [
                    'size' => 6,
                    'colors' => ['#1f77b4'],
                    'strokeColors' => '#fff',
                    'strokeWidth' => 2,
                    'hover' => ['size' => 8],
                ],
                'grid' => [
                    'show' => true,
                    'borderColor' => '#e0e6ed',
                    'strokeDashArray' => 5,
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'style' => [
                        'fontSize' => '12px',
                        'fontWeight' => 'bold',
                        'colors' => ['#304758'],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'y' => [
                        'formatter' => 'function(val) { return val + " children"; }',
                    ],
                ],
                'responsive' => [
                    [
                        'breakpoint' => 480,
                        'options' => [
                            'chart' => ['width' => '100%'],
                            'legend' => ['position' => 'bottom'],
                        ],
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

    public static function girinkaStats(): Chart
    {
        $girinkaData = Girinka::selectRaw('YEAR(distribution_date) as year, COUNT(*) as count')
            ->whereNotNull('distribution_date')
            ->groupBy('year')
            ->orderBy('year')
            ->get();
        $male = Girinka::where('gender', 'M')->count();
        $female = Girinka::where('gender', 'F')->count();
        $cows = Girinka::count();

        $chart = new Chart;
        $totalGirinkaBeneficiaries = Girinka::count();

        return $chart->setType('donut')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($girinkaData->pluck('year')->toArray())
            ->setDataset('Girinka Distribution', 'donut', $girinkaData->pluck('count')->toArray())
            ->setOptions([
                'chart' => [
                    'type' => 'donut',
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'legend' => [
                    'position' => 'bottom',
                ],
                'title' => [
                    'text' => 'Girinka Distribution by Year',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalGirinkaBeneficiaries.' Female beneficiaries is: '.$female.' Male beneficiaries: '.$male.' Total cows :'.$cows,
                    'align' => 'left',
                ],
            ]);
    }

    public static function goatDistribution(): Chart
    {
        $totalBeneficiaries = (int) Goat::count();

        $data = Goat::query()
            ->selectRaw('CASE WHEN gender = "M" THEN "Male" ELSE "Female" END as gender, SUM(number_of_goats) as total')
            ->whereIn('gender', ['M', 'F'])
            ->groupBy('gender')
            ->orderBy('gender')
            ->get();

        $labels = $data->pluck('gender')->toArray();
        $values = $data->pluck('total')->map(fn ($value) => (int) $value)->toArray();

        $totalGoats = (int) Goat::sum('number_of_goats');

        // Count of male and female beneficiaries
        $maleBeneficiaries = (int) Goat::where('gender', 'M')->count();
        $femaleBeneficiaries = (int) Goat::where('gender', 'F')->count();

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
                    'text' => 'Beneficiaries who benefited in Goat Distribution',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.number_format($totalBeneficiaries).
                        '   Total Goats: '.number_format($totalGoats).
                        '   Male Beneficiaries: '.number_format($maleBeneficiaries).
                        '   Female Beneficiaries: '.number_format($femaleBeneficiaries),
                    'align' => 'left',
                    'style' => [
                        'fontSize' => '14px',
                        'margin' => '10px',
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
        $males = Scholarship::where('gender', 'M')->count();
        $females = Scholarship::where('gender', 'F')->count();

        return (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($years)
            ->setDataset('Scholars', 'bar', $counts)
            ->setColors(['#657278'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                        'barHeight' => '70%',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Number of Scholars',
                    ],
                    'categories' => $years,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Entrance Year',
                    ],
                ],
                'title' => [
                    'text' => 'Provided scholarship by year',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total scholarships: '.$totalScholarship.' Total female scholars is: '.$females.' Total male scholars is: '.$males,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => false,
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

        $totalToolkits = Toolkit::count();
        $chart = new Chart();
        $toolkits = array_keys($mvtcData);
        $counts = array_values($mvtcData);

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

    public static function vslaLoanData(): Chart
    {
        $vslaData = Vsla::select(DB::raw('TRIM(vlsa) as vlsa'), DB::raw('count(*) as total'))
            ->whereNotNull('vlsa')
            ->where('vlsa', '!=', '')
            ->groupBy('vlsa')
            ->orderBy('vlsa')
            ->get();

        $vslaNames = $vslaData->pluck('vlsa')->unique()->values()->toArray();
        $totals = $vslaData->pluck('total')->toArray();
        $totalVslas = array_sum($totals);

        $chart = new Chart();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($vslaNames)
            ->setSeries([
                [
                    'name' => 'Total Members',
                    'data' => $totals,
                ],
            ])
            ->setColors(['#B2071B'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                    'stacked' => false,
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                        'barHeight' => '70%',
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Number of Members',
                    ],
                    'categories' => $vslaNames,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'VSLA Groups',
                    ],
                ],
                'title' => [
                    'text' => 'Total VSLA Members by Group',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Members Across All VSLAs: '.$totalVslas,
                    'align' => 'center',
                ],
                'legend' => [
                    'show' => false,
                ],
            ]);
    }

    public static function mvtcChart(): Chart
    {
        $mvtcData = Mvtc::selectRaw('trade, COUNT(*) as count')
            ->whereNotNull('trade')
            ->groupBy('trade')
            ->pluck('count', 'trade')
            ->toArray();
        $males = Mvtc::where('gender', 'MALE')->count();
        $females = Mvtc::where('gender', 'FEMALE')->count();

        $totalStudents = Mvtc::count();
        $chart = new Chart();
        $trades = array_keys($mvtcData);
        $counts = array_values($mvtcData);

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
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                        'barHeight' => '70%',
                        'distributed' => false,
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'stroke' => [
                    'width' => 1,
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Number of Students',
                    ],
                    'categories' => $trades,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Trades',
                    ],
                ],
                'title' => [
                    'text' => 'MVTC Graduates by Trades',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total students: '.$totalStudents.' Graduated female is '.$females.' Graduated male is '.$males,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
                'grid' => [
                    'show' => true,
                ],
            ]);
    }

    public static function urgentCommunitySupportChart(): Chart
    {
        $beneficiaries = Urgent::select('support')->selectRaw('count(*) as total')
            ->groupBy('support')->orderBy('support')->pluck('total', 'support')->toArray();
        $totalBeneficiaries = Urgent::count();
        $males = Urgent::where('gender', 'M')->count();
        $females = Urgent::where('gender', 'F')->count();
        $chart = new Chart();
        $supports = array_keys($beneficiaries);
        $total = array_values($beneficiaries);

        return $chart->setType('bar')->setWidth('100%')
            ->setHeight(500)->setLabels($supports)
            ->setDataset('Beneficiaries reach out in urgent community support', 'bar', $total)
            ->setColors(['#b2071b'])
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
                        'text' => 'Supports',
                    ],
                    'categories' => $supports,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of beneficiaries',
                    ],
                ],
                'title' => [
                    'text' => 'Beneficiaries in Urgent Community Support',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total beneficiaries is '.$totalBeneficiaries.' Total female is '.$females.' Total male is '.$males,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'bottom',
                    'horizontalAlign' => 'left',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " supports" }',
                    ],
                ],
            ]);

    }
}
