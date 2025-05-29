<?php

declare(strict_types=1);

namespace App\View\Components;

use Akaunting\Apexcharts\Chart;
use App\Models\SchoolFeeding;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

final class SchoolFeedingComponent extends Component
{
    public Chart $schoolFeedingChart;

    public function __construct()
    {
        $this->schoolFeedingChart = $this->createChart();
    }

    public function createChart(): Chart
    {

        $data = SchoolFeeding::select('academic_year', DB::raw('COUNT(*) as total'))
            ->whereNotNull('academic_year')
            ->where('academic_year', '!=', '')
            ->groupBy('academic_year')
            ->orderBy('academic_year', 'DESC')
            ->pluck('total', 'academic_year')
            ->toArray();

        $years = array_keys($data);
        $totals = array_values($data);
        $totalStudents = array_sum($totals);

        $legendLabels = [];
        foreach ($data as $year => $count) {
            $legendLabels[] = $year.' ('.$count.' students)';
        }

        $chart = new Chart();

        return $chart->setType('donut')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($legendLabels)
            ->setDataset('Total Students by Year', 'donut', $totals)
            ->setColors(['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b', '#e377c2'])
            ->setOptions([
                'chart' => [
                    'type' => 'donut',
                    'toolbar' => [
                        'show' => true,
                    ],
                ],
                'title' => [
                    'text' => 'School feeding Distribution by Academic Year',
                    'align' => 'center',
                ],
                'subtitle' => [
                    'text' => 'Total Students: '.$totalStudents,
                    'align' => 'center',
                ],
                'legend' => [
                    'show' => true,
                    'position' => 'bottom',
                ],
                'plotOptions' => [
                    'pie' => [
                        'donut' => [
                            'labels' => [
                                'show' => true,
                                'total' => [
                                    'show' => true,
                                    'showAlways' => true,
                                    'label' => 'Total Students',
                                    'fontSize' => '16px',
                                    'fontWeight' => 600,
                                ],
                            ],
                        ],
                    ],
                ],
                'dataLabels' => [
                    'enabled' => true,
                    'style' => [
                        'fontSize' => '12px',
                        'fontWeight' => 'bold',
                    ],
                ],
                'responsive' => [
                    [
                        'breakpoint' => 480,
                        'options' => [
                            'chart' => [
                                'width' => 200,
                            ],
                            'legend' => [
                                'position' => 'bottom',
                            ],
                        ],
                    ],
                ],
            ]);
    }

    public function render(): View
    {
        return view('components.school-feeding-component', ['schoolFeedingChart' => $this->schoolFeedingChart]);
    }
}
