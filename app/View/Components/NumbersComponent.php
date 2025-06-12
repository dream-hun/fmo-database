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
use App\Models\Urgent;
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
        $total = Ecd::count() + Empowerment::sum('supported_children') + Fruit::count() + Girinka::count() + Individual::count() + Livestock::count() + Malnutrition::count() + Member::count() + Mvtc::count() + Scholarship::count() + Scholarship::count() + Scholarship::count() + SchoolFeeding::count() + Tank::count() + Toolkit::count() + Training::count() + Urgent::sum('benefiting_members') + Zamuka::count();

        return view('components.numbers-component', ['total' => $total]);
    }
}
