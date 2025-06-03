<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Helpers\TotalNumbers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class NumbersComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $totalBeneficiaries = TotalNumbers::getAllCounts();
        $female = TotalNumbers::femaleBeneficiaries();
        $male = TotalNumbers::getMalnutrition();

        return view('components.numbers-component', ['total' => $totalBeneficiaries,
            'female' => $female,
            'male' => $male]);
    }
}
