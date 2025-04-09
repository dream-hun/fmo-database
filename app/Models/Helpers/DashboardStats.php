<?php

namespace App\Models\Helpers;

use Akaunting\Apexcharts\Chart;
use App\Models\Girinka;

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
}
