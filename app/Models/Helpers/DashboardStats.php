<?php

declare(strict_types=1);

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Ecd;
use App\Models\Empowerment;
use App\Models\Fruit;
use App\Models\Girinka;
use App\Models\Group;
use App\Models\Livestock;
use App\Models\Loan;
use App\Models\Malnutrition;
use App\Models\Member;
use App\Models\Mvtc;
use App\Models\Scholarship;
use App\Models\Tank;
use App\Models\Toolkit;
use App\Models\Training;
use App\Models\Urgent;
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
                    'text' => 'Malnutrition & Child Growth Stunting Prevention',
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
            ->setDataset('Number of ECD children', 'line', $counts)
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
                        'text' => 'Number of children',
                        'align' => 'left',
                    ],
                ],
                'title' => [
                    'text' => 'Kimaranzara child protection center (ECD model)',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total children: '.$totalEcd,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'left',

                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " children" }',
                    ],
                ],
            ]);
    }

    public static function ecdEmpowerment(): Chart
    {
        $empowerment = Empowerment::select('name', 'supported_children')
            ->orderBy('supported_children', 'desc')->pluck('supported_children', 'name')
            ->toArray();
        $supportedChildren = Empowerment::sum('supported_children');
        $empoweredEcd = Empowerment::count('name');
        $chart = new Chart();
        $empowerments = array_keys($empowerment);
        $counts = array_values($empowerment);

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($empowerments)
            ->setDataset('Number of Empowerments', 'line', $counts)
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
                        'text' => 'Empowered ECDs',
                    ],
                    'categories' => $empowerments,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Supported Children',
                    ],
                ],
                'title' => [
                    'text' => 'ECD Empowerments and supported Children',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total supported children: '.$supportedChildren.' Empowered ECDs '.$empoweredEcd,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'center',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " empowerments" }',
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

        // Handle empty data
        if ($girinkaData->isEmpty()) {
            $labels = ['No Data'];
            $values = [1];
        } else {
            $labels = $girinkaData->pluck('year')->toArray();
            $values = $girinkaData->pluck('count')->toArray();
        }

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($labels)
            ->setDataset('Girinka Distribution', 'bar', $values)
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
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
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Years',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Distributions',
                    ],
                ],
            ]);
    }

    public static function sanitationStat(): Chart
    {
        $sanitation = Tank::selectRaw('gender, COUNT(*) as count')
            ->whereNotNull('gender')
            ->groupBy('gender')
            ->orderBy('gender')
            ->get();

        $male = Tank::where('gender', 'M')->count();
        $female = Tank::where('gender', 'F')->count();
        $community = Tank::where('gender', 'C')->count();
        $totalTanks = Tank::count();

        $labels = [];
        $data = [];

        // Handle empty data
        if ($sanitation->isEmpty()) {
            $labels = ['No Data'];
            $data = [1];
        } else {
            foreach ($sanitation as $item) {
                if ($item->gender === 'M') {
                    $genderLabel = 'Male';
                } elseif ($item->gender === 'F') {
                    $genderLabel = 'Female';
                } elseif ($item->gender === 'C') {
                    $genderLabel = 'Community';
                } else {
                    $genderLabel = $item->gender;
                }
                $labels[] = $genderLabel;
                $data[] = $item->count;
            }
        }

        $chart = new Chart;

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($labels)
            ->setDataset('Clean Water And Sanitation Tanks', 'bar', $data)
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                ],
                'dataLabels' => [
                    'enabled' => true,
                ],
                'legend' => [
                    'position' => 'bottom',
                ],
                'title' => [
                    'text' => 'Clean Water And Sanitation Distribution',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => "Total Beneficiaries: {$totalTanks} | Female: {$female} | Male: {$male} | Community: {$community}",
                    'align' => 'left',
                ],
                'colors' => ['#b2071b', '#4ECDC4'],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Gender',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Beneficiaries',
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function(val) { return val + " beneficiaries"; }',
                    ],
                ],
            ]);
    }

    public static function fruitTrees(): Chart
    {
        $fruitsData = Fruit::selectRaw('YEAR(distribution_date) as year, COUNT(*) as count')
            ->whereNotNull('distribution_date')
            ->groupBy('year')->orderBy('year')->get();
        $male = Fruit::where('gender', 'M')->count();
        $female = Fruit::where('gender', 'F')->count();
        $institution = Fruit::where('gender', 'Institution')->count();
        $chart = new Chart;
        $totalFruitBeneficiaries = Fruit::count();

        // Handle empty data
        if ($fruitsData->isEmpty()) {
            $labels = ['No Data'];
            $values = [1];
        } else {
            $labels = $fruitsData->pluck('year')->toArray();
            $values = $fruitsData->pluck('count')->toArray();
        }

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($labels)
            ->setDataset('Fruits trees ', 'bar', $values)
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
                'colors' => ['#b2071b'],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => false,
                        'columnWidth' => '55%',
                        'endingShape' => 'rounded',
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Years',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Distributions',
                    ],
                ],
                'title' => [
                    'text' => 'Fruit Trees Distribution by Year',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalFruitBeneficiaries.' Female beneficiaries is: '.$female.' Male beneficiaries: '.$male.' Total Institutions :'.$institution,
                    'align' => 'left',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function(val) { return val + " distributions"; }',
                    ],
                ],
            ]);
    }

    public static function LivestockDistribution(): Chart
    {
        $totalBeneficiaries = Livestock::count();
        $totalLivestock = (int) Livestock::sum('number');

        // Get all unique years from distribution_date
        $years = Livestock::selectRaw('YEAR(distribution_date) as year')
            ->whereNotNull('distribution_date')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        // If no data, set default values
        if (empty($years)) {
            $years = ['No Data'];
            $totalsByYear = [0];
            $typeBreakdown = 'No livestock data available';
        } else {
            // Get total livestock distributed per year (summing across all types)
            $yearlyData = Livestock::selectRaw('YEAR(distribution_date) as year, SUM(number) as total')
                ->whereNotNull('distribution_date')
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('total', 'year')
                ->toArray();

            $totalsByYear = [];
            foreach ($years as $year) {
                $totalsByYear[] = isset($yearlyData[$year]) ? (int) $yearlyData[$year] : 0;
            }

            // Create type breakdown for subtitle (keep this for reference)
            $typeBreakdown = Livestock::select('type', DB::raw('SUM(number) as total'))
                ->whereNotNull('type')
                ->where('type', '!=', '')
                ->groupBy('type')
                ->get()
                ->pluck('total', 'type')
                ->map(function ($count, $type) {
                    return ucfirst(mb_trim($type)).': '.number_format((int) $count);
                })
                ->implode(' | ');
        }

        return (new Chart)
            ->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($years)
            ->setDataset('Total Livestock', 'bar', $totalsByYear)
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
                'legend' => [
                    'show' => true,
                    'position' => 'bottom',
                ],
                'title' => [
                    'text' => 'Total Small Livestock Distribution by Year',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.number_format($totalBeneficiaries).
                        ' | Total Livestock: '.number_format($totalLivestock).
                        ($typeBreakdown ? ' | '.$typeBreakdown : ''),
                    'align' => 'left',
                    'style' => [
                        'fontSize' => '14px',
                    ],
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Years',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Livestock',
                    ],
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function(val) { return val + " livestock"; }',
                    ],
                ],
            ]);
    }

    public static function individualStats(): Chart
    {
        $yearlyLoanPeople = Loan::selectRaw('YEAR(done_at) as year, COUNT(DISTINCT individual_id) as total_people')
            ->whereNotNull('done_at')
            ->groupByRaw('YEAR(done_at)')
            ->orderBy('year', 'asc')
            ->get();
        $totalLoanPeople = Loan::distinct('individual_id')->count('individual_id');
        $loanYears = $yearlyLoanPeople->pluck('year')->toArray();
        $loanCounts = $yearlyLoanPeople->pluck('total_people')->toArray();
        $chart = new Chart;

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($loanYears)
            ->setDataset('Individual Loan Distribution by Years', 'bar', $loanCounts)
            ->setColors(['#657278'])
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
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
                    'colors' => ['#657278'],
                    'curve' => 'straight',
                ],
                'xaxis' => [
                    'title' => [
                        'text' => 'Number of Individuals',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Years',
                    ],
                ],
                'fill' => [
                    'opacity' => 1,
                ],
                'title' => [
                    'text' => 'Individual Loan Distribution by Years',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Individuals with Loans: '.$totalLoanPeople,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'left',
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
        $mvtcData = Toolkit::selectRaw('business_name, COUNT(*) as count')
            ->whereNotNull('business_name')
            ->groupBy('business_name')
            ->pluck('count', 'business_name')
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
                        'text' => 'Number of beneficiaries received toolkits',
                    ],
                    'categories' => $toolkits,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Toolkits',
                    ],
                ],
                'title' => [
                    'text' => 'Toolkit Distributions',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total beneficiaries: '.$totalToolkits,
                    'align' => 'left',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'top',
                    'horizontalAlign' => 'left',
                ],
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " students" }',
                    ],
                ],

            ]);

    }

    public static function groupMemberData(): Chart
    {

        $groupData = Group::withCount('members')
            ->having('members_count', '>', 0)
            ->orderBy('name')
            ->get();

        $males = Member::where('gender', 'M')->count();
        $females = Member::where('gender', 'F')->count();
        $totalGroups = Group::count();

        // Extract data for chart
        $groupNames = $groupData->pluck('name')->toArray();
        $memberCounts = $groupData->pluck('members_count')->toArray();
        $totalMembers = array_sum($memberCounts);

        $chart = new Chart();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($groupNames)
            ->setSeries([
                [
                    'name' => 'Total Members',
                    'data' => $memberCounts,
                ],
            ])
            ->setColors(['#657278'])
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
                    'categories' => $groupNames,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'VSLAs',
                    ],
                ],
                'title' => [
                    'text' => 'Total Members by VSLA',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total Members Across All VSLAs: '.$totalMembers.' | Female: '.$females.' | Male: '.$males.' | Total Vsla: '.$totalGroups,
                    'align' => 'left',
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

    public static function trainingChart(): Chart
    {

        $trainingData = Training::select('training_given', DB::raw('count(*) as total'))
            ->whereNotNull('training_given')
            ->groupBy('training_given')
            ->get();

        $trainingLabels = $trainingData->pluck('training_given')->toArray();
        $trainingCounts = $trainingData->pluck('total')->toArray();

        $males = Training::where('gender', 'M')->count();
        $females = Training::where('gender', 'F')->count();
        $totalTrainees = Training::count();

        $chart = new Chart();

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($trainingLabels)
            ->setDataset('Number of Trainees', 'bar', $trainingCounts)
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
                        'text' => 'Number of Trainees',
                    ],
                    'categories' => $trainingLabels, // Training names as categories
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Training Types',
                    ],
                ],
                'title' => [
                    'text' => 'Specialised Training For Community Capacity Building',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total trainees: '.$totalTrainees.' | Female: '.$females.' | Male: '.$males,
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
