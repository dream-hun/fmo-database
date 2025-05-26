<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEcdRequest;
use App\Http\Requests\Admin\UpdateEcdRequest;
use App\Models\Ecd;

final class EcdController extends Controller
{
    public function index()
    {
        $ecds = Ecd::select(['uuid', 'id', 'name', 'academic_year', 'gender', 'sector'])->get();

        return view('admin.ecds.index', compact('ecds'));
    }

    public function create()
    {
        return view('admin.ecds.create');
    }

    public function store(StoreEcdRequest $request)
    {
        Ecd::create($request->all());

        return to_route('ecds.index')->with('success', 'New ecd student is added successfully.');
    }

    public function show(Ecd $ecd)
    {
        return view('admin.ecds.show', compact('ecd'));
    }

    public function edit(Ecd $ecd)
    {
        return view('admin.ecds.edit', compact('ecd'));
    }

    public function update(UpdateEcdRequest $request, Ecd $ecd)
    {
        $ecd->update($request->all());

        return to_route('ecds.index')->with('success', 'Ecd student is updated successfully.');
    }

    public function destroy(Ecd $ecd)
    {
        $ecd->delete();

        return to_route('ecds.index')->with('success', 'Ecd student is deleted successfully.');
    }
}
