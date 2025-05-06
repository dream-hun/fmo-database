<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Vsla;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class VslaChartComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $vslas = Vsla::selectRaw('year, SUM(beneficiaries) as total_beneficiaries, COUNT(*) as vsla_count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return view('components.vsla-chart-component', [
            'years' => $vslas->pluck('year'),
            'beneficiaries' => $vslas->pluck('total_beneficiaries'),
            'vslaCounts' => $vslas->pluck('vsla_count'),
        ]);
    }
}
