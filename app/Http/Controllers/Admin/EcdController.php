<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEcdRequest;
use App\Http\Requests\Admin\UpdateEcdRequest;
use App\Models\Ecd;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class EcdController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ecd_access'), Response::HTTP_FORBIDDEN, 403);
        $ecds = Ecd::select(['id', 'name', 'academic_year', 'gender', 'grade', 'home_phone'])->get();

        return view('admin.ecds.index', compact('ecds'));
    }

    public function create()
    {
        abort_if(Gate::denies('ecd_create'), Response::HTTP_FORBIDDEN, 403);

        return view('admin.ecds.create');
    }

    public function store(StoreEcdRequest $request)
    {
        $ecd = Ecd::create($request->validated());

        return to_route('admin.ecds.index')->with('success', $ecd->name.' student is added successfully.');
    }

    public function show(Ecd $ecd)
    {
        abort_if(Gate::denies('ecd_view'), Response::HTTP_FORBIDDEN, 403);

        return view('admin.ecds.show', compact('ecd'));
    }

    public function edit(Ecd $ecd)
    {
        abort_if(Gate::denies('ecd_edit'), Response::HTTP_FORBIDDEN, 403);

        return view('admin.ecds.edit', compact('ecd'));
    }

    public function update(UpdateEcdRequest $request, Ecd $ecd)
    {
        $ecd->update($request->validated());

        return to_route('ecds.index')->with('success', $ecd->name.' student is updated successfully.');
    }

    public function destroy(Ecd $ecd)
    {
        abort_if(Gate::denies('ecd_delete'), Response::HTTP_FORBIDDEN, 403);
        $ecd->delete();

        return to_route('ecds.index')->with('success', $ecd->name.' is deleted successfully.');
    }
}
