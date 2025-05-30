<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFoodAndHouseRequest;
use App\Http\Requests\Admin\UpdateFoodAndHouseRequest;
use App\Models\FoodAndHouse;
use App\Models\Traits\CsvImportTrait;
use Gate;
use Symfony\Component\HttpFoundation\Response;

final class FoodAndHouseController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('food_and_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodAndHouses = FoodAndHouse::all();

        return view('admin.foodAndHouses.index', compact('foodAndHouses'));
    }

    public function create()
    {
        abort_if(Gate::denies('food_and_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.foodAndHouses.create');
    }

    public function store(StoreFoodAndHouseRequest $request)
    {
        $foodAndHouse = FoodAndHouse::create($request->all());

        return redirect()->route('admin.food-and-houses.index');
    }

    public function edit(FoodAndHouse $foodAndHouse)
    {
        abort_if(Gate::denies('food_and_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.foodAndHouses.edit', compact('foodAndHouse'));
    }

    public function update(UpdateFoodAndHouseRequest $request, FoodAndHouse $foodAndHouse)
    {
        $foodAndHouse->update($request->all());

        return redirect()->route('admin.food-and-houses.index');
    }

    public function destroy(FoodAndHouse $foodAndHouse)
    {
        abort_if(Gate::denies('food_and_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodAndHouse->delete();

        return back();
    }
}
