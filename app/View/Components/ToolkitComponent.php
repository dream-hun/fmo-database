<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Helpers\DashboardStats;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ToolkitComponent extends Component
{
    public function render(): View|Closure|string
    {
        $toolkitChart = DashboardStats::toolKit();

        return view('components.toolkit-component', [
            'years' => $toolkitChart['years'],
            'series' => $toolkitChart['series'],
        ]);
    }
}
