<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | ApexCharts Default Options
    |--------------------------------------------------------------------------
    |
    | Here you may define the default options that will be applied to all
    | ApexCharts rendered using this package. To learn more about each
    | available option, check the official ApexCharts documentation.
    |
    | https://apexcharts.com/docs/options/
    |
    */

    'options' => [
        'chart' => [
            'type' => 'line',
            'height' => 500,
            'width' => null,
            'toolbar' => [
                'show' => true,
                'tools' => [
                    'download' => true,
                    'selection' => true,
                    'zoom' => true,
                    'zoomin' => true,
                    'zoomout' => true,
                    'pan' => true,
                    'reset' => true,
                ],
            ],
            'zoom' => [
                'enabled' => true,
            ],
            'fontFamily' => 'inherit',
            'foreColor' => '#373d3f',
        ],

        'plotOptions' => [
            'bar' => [
                'horizontal' => false,
            ],
            'line' => [
                'strokeWidth' => 3,
            ],
        ],

        'colors' => [
            '#b2071b', '#657278', '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '#00a9f4', '#2ccdc9', '#5e72e4',
        ],

        'series' => [],

        'dataLabels' => [
            'enabled' => false,
        ],

        'labels' => [],

        'title' => [
            'text' => null,
            'align' => 'center',
            'style' => [
                'fontSize' => '16px',
                'fontWeight' => 'bold',
            ],
        ],

        'subtitle' => [
            'text' => null,
            'align' => 'center',
        ],

        'xaxis' => [
            'type' => 'category',
            'categories' => [],
            'tickPlacement' => 'on',
            'labels' => [
                'rotate' => -45,
                'rotateAlways' => false,
            ],
        ],

        'grid' => [
            'show' => true,
            'borderColor' => '#e7e7e7',
            'strokeDashArray' => 0,
            'position' => 'back',
            'row' => [
                'colors' => ['#f3f3f3', 'transparent'],
                'opacity' => 0.5,
            ],
        ],

        'markers' => [
            'size' => 6,
            'strokeWidth' => 3,
            'fillOpacity' => 1,
            'hover' => [
                'size' => 8,
            ],
        ],

        'stroke' => [
            'show' => true,
            'curve' => 'smooth',
            'lineCap' => 'butt',
            'width' => 3,
            'dashArray' => 0,
        ],

        'legend' => [
            'show' => true,
            'showForSingleSeries' => true,
            'position' => 'bottom',
            'horizontalAlign' => 'center',
            'floating' => false,
            'fontSize' => '13px',
            'offsetY' => 0,
        ],
    ],

];
