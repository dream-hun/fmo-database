<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Ecd;
use App\Models\Empowerment;
use App\Models\Fruit;
use App\Models\Girinka;
use App\Models\Individual;
use App\Models\Livestock;
use App\Models\Malnutrition;
use App\Models\Member;
use App\Models\Mvtc;
use App\Models\Scholarship;
use App\Models\SchoolFeeding;
use App\Models\Tank;
use App\Models\Toolkit;
use App\Models\Training;
use App\Models\Zamuka;
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
        $maleCount = Ecd::getMaleCount() + Fruit::getMaleCount() + Girinka::getMaleCount()
            + Livestock::getMaleCount() + Malnutrition::getMaleCount() + Member::getMaleCount()
            + Mvtc::getMaleCount() + Scholarship::getMaleCount() + SchoolFeeding::getMaleCount()
            + Toolkit::getMaleCount() + Training::getMaleCount() + Tank::getMaleCount() + Individual::getMaleCount();

        $femaleCount = Ecd::getFemaleCount() + Fruit::getFemaleCount() + Girinka::getFemaleCount()
            + Livestock::getFemaleCount() + Malnutrition::getFemaleCount() + Member::getFemaleCount()
            + Mvtc::getFemaleCount() + Scholarship::getFemaleCount() + SchoolFeeding::getFemaleCount()
            + Toolkit::getFemaleCount() + Training::getFemaleCount() + Tank::getFemaleCount() + Individual::getFemaleCount();

        $otherCount = Empowerment::total() + Individual::getGroupCount() + Tank::getCommunityCount() + Zamuka::total();

        $total = $maleCount + $femaleCount + $otherCount;

        return view('components.numbers-component', [
            'total' => $total,
            'male' => $maleCount,
            'female' => $femaleCount,
            'other' => $otherCount,
        ]);
    }
}
