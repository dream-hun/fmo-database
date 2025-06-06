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
            ->orderBy('academic_year', 'ASC') // Changed to ASC for proper line chart progression
            ->pluck('total', 'academic_year')
            ->toArray();

        $years = array_keys($data);
        $totals = array_values($data);
        $totalStudents = array_sum($totals);
        $males = SchoolFeeding::where('gender', 'M')->count();
        $females = SchoolFeeding::where('gender', 'F')->count();

        $chart = new Chart();

        return $chart->setType('line')
            ->setWidth('100%')
            ->setHeight(500)
            ->setLabels($years)
            ->setDataset('Students', 'line', $totals)
            ->setColors(['#b2071b'])
            ->setOptions([
                'chart' => [
                    'type' => 'line',
                    'toolbar' => [
                        'show' => true,
                    ],
                    'zoom' => [
                        'enabled' => true,
                    ],
                ],
                'title' => [
                    'text' => 'School Feeding Chart by Academic Year',
                    'align' => 'left',
                ],
                'subtitle' => [
                    'text' => 'Total number of Students: '.$totalStudents.' Number of female is '.$females.' Number of male is '.$males,
                    'align' => 'left',
                ],
                'xaxis' => [
                    'categories' => $years,
                    'title' => [
                        'text' => 'Academic Year',
                    ],
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Number of Students',
                    ],
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
                    'hover' => [
                        'size' => 8,
                    ],
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
                        'formatter' => 'function(val) { return val + " students"; }',
                    ],
                ],
                'responsive' => [
                    [
                        'breakpoint' => 480,
                        'options' => [
                            'chart' => [
                                'width' => '100%',
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
        return view('components.school-feeding-component',
            ['schoolFeedingChart' => $this->schoolFeedingChart]);
    }
}
