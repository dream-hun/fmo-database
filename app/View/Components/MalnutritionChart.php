<?php

declare(strict_types=1);

namespace App\View\Components;

use Akaunting\Apexcharts\Chart;
use App\Models\Malnutrition;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

final class MalnutritionChart extends Component
{
    public Chart $malnutritionChart;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->malnutritionChart = $this->getChart();
    }

    public function getChart(): Chart
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
            ->setColors(['#1f77b4'])
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

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.malnutrition-chart', ['malnutritionChart' => $this->malnutritionChart]);
    }
}
