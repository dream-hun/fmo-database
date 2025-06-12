<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTankRequest;
use App\Http\Requests\Admin\UpdateTankRequest;
use App\Models\Tank;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class TankController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tanks = Tank::all();

        return view('admin.tanks.index', compact('tanks'));
    }

    public function create()
    {
        abort_if(Gate::denies('tank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tanks.create');
    }

    public function store(StoreTankRequest $request)
    {
        $tank = Tank::create($request->all());

        return redirect()->route('admin.tanks.index');
    }

    public function edit(Tank $tank)
    {
        abort_if(Gate::denies('tank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tanks.edit', compact('tank'));
    }

    public function update(UpdateTankRequest $request, Tank $tank)
    {
        $tank->update($request->all());

        return redirect()->route('admin.tanks.index');
    }

    public function destroy(Tank $tank)
    {
        abort_if(Gate::denies('tank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tank->delete();

        return back();
    }
}
