<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTankRequest;
use App\Http\Requests\StoreTankRequest;
use App\Http\Requests\UpdateTankRequest;
use App\Models\Tank;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TankController extends Controller
{
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

    public function show(Tank $tank)
    {
        abort_if(Gate::denies('tank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tanks.show', compact('tank'));
    }

    public function destroy(Tank $tank)
    {
        abort_if(Gate::denies('tank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tank->delete();

        return back();
    }

    public function massDestroy(MassDestroyTankRequest $request)
    {
        $tanks = Tank::find(request('ids'));

        foreach ($tanks as $tank) {
            $tank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
