<?php

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Girinka;
use App\Models\Individual;

class DashboardStats
{
    /**
     * Get gender distribution chart based on all projects
     */
    public static function genderDistribution(): Chart
    {
        $totalBeneficiaries = TotalNumbers::getAllCounts();
        $female = TotalNumbers::femaleBeneficiaries();
        $male = $totalBeneficiaries - $female;

        $chart = new Chart;

        return $chart->setType('donut')
            ->setWidth('100%')
            ->setHeight(300)
            ->setLabels(['Male', 'Female'])
            ->setDataset('Gender Distribution Across All Projects', 'donut', [$male, $female])
            ->setColors(['#657278', '#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'donut',
                ],
                'plotOptions' => [
                    'pie' => [
                        'donut' => [
                            'size' => '70%',
                            'labels' => [
                                'show' => true,
                                'name' => [
                                    'show' => true,
                                ],
                                'value' => [
                                    'show' => true,
                                    'formatter' => 'function (val) { return val }',
                                ],
                            ],
                        ],
                    ],
                ],
                'legend' => [
                    'position' => 'bottom',
                    'horizontalAlign' => 'center',
                ],
                'title' => [
                    'text' => 'Gender Distribution',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Beneficiaries: '.$totalBeneficiaries,
                    'align' => 'center',
                ],
            ]);
    }

    public static function girinkaStats(): Chart
    {
        $girinkaData = \App\Models\Girinka::selectRaw('YEAR(distribution_date) as year, COUNT(*) as count')
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
                    'enabled' => false,
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
                'tooltip' => [
                    'y' => [
                        'formatter' => 'function (val) { return val + " distributions" }',
                    ],
                ],
            ]);
    }

    public static function individualLoanStats(): Chart
    {
        $loanData = Individual::selectRaw('YEAR(loan_date) as year, COUNT(*) as count, SUM(loan_amount) as total_amount')
            ->whereNotNull('loan_date')
            ->groupBy(\DB::raw('YEAR(loan_date)'))
            ->orderBy('year')
            ->get();

        $years = $loanData->pluck('year')->toArray();
        $counts = $loanData->pluck('count')->toArray();
        $amounts = $loanData->pluck('total_amount')->toArray();

        if (empty($years)) {
            $currentYear = date('Y');
            $years = [$currentYear - 1, $currentYear];
            $counts = [0, 0];
            $amounts = [0, 0];
        }

        $chart = new Chart;

        return $chart->setType('bar')
            ->setWidth('100%')
            ->setHeight(400)
            ->setDataset('Number of Loans', 'bar', $counts)
            ->setDataset('Total Amount (RWF)', 'bar', $amounts)
            ->setOptions([
                'chart' => [
                    'type' => 'bar',
                    'stacked' => false,
                    'toolbar' => ['show' => true],
                    'animations' => ['enabled' => true],
                ],
                'plotOptions' => [
                    'bar' => [
                        'horizontal' => true,
                        'dataLabels' => ['position' => 'top'],
                        'barHeight' => '70%',
                    ],
                ],
                'series' => [
                    ['name' => 'Number of Loans', 'data' => $counts],
                    ['name' => 'Total Amount (RWF)', 'data' => $amounts],
                ],
                'colors' => ['#b2071b', '#657278'],
                'dataLabels' => [
                    'enabled' => true,
                    'textAnchor' => 'start',
                    'style' => ['fontSize' => '12px', 'colors' => ['#fff']],
                    'formatter' => 'function(val, opt) {
                        return opt.w.globals.seriesNames[opt.seriesIndex] === "Number of Loans" ?
                            val + " loans" :
                            val.toLocaleString() + " RWF";
                    }',
                    'offsetX' => 0,
                ],
                'title' => [
                    'text' => 'Yearly Individual Loan Distribution',
                    'align' => 'center',
                ],
                'grid' => [
                    'borderColor' => '#e7e7e7',
                    'xaxis' => ['lines' => ['show' => true]],
                    'yaxis' => ['lines' => ['show' => false]],
                    'padding' => ['top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0],
                ],
                'xaxis' => [
                    'categories' => $years,
                    'title' => ['text' => 'Values'],
                    'labels' => ['style' => ['colors' => '#373d3f']],
                ],
                'yaxis' => [
                    'title' => ['text' => 'Year'],
                    'labels' => ['style' => ['colors' => '#373d3f']],
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'bottom',
                    'horizontalAlign' => 'center',
                    'floating' => false,
                    'fontSize' => '14px',
                    'markers' => ['size' => 8],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'shared' => false,
                    'x' => ['show' => true],
                    'y' => [
                        'formatter' => 'function(val, { series, seriesIndex, dataPointIndex, w }) {
                            return w.globals.seriesNames[seriesIndex] === "Number of Loans" ?
                                val + " loans" :
                                val.toLocaleString() + " RWF";
                        }',
                    ],
                ],
            ]);
    }
}
