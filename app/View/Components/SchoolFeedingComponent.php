<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\SchoolFeeding;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Log;

final class SchoolFeedingComponent extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $data = SchoolFeeding::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('YEAR(academic_year) as year')
        )
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->pluck('total', 'year')
            ->toArray();

        // Debug the data to see what's being returned
        Log::info('School Feeding Data:', $data);

        return view('components.school-feeding-component', ['data' => $data]);
    }
}
