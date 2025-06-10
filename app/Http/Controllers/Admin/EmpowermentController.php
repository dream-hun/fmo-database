<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmpowermentRequest;
use App\Http\Requests\Admin\UpdateEmpowermentRequest;
use App\Models\Empowerment;
use App\Models\Traits\CsvImportTrait;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class EmpowermentController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('empowerment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empowerments = Empowerment::all();

        return view('admin.empowerments.index', compact('empowerments'));
    }

    public function create()
    {
        abort_if(Gate::denies('empowerment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowerments.create');
    }

    public function store(StoreEmpowermentRequest $request)
    {
        $empowerment = Empowerment::create($request->all());

        return to_route('admin.empowerments.index')->with('message', $empowerment->name.' Empowerment created successfully');

    }

    public function show(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowerments.show', compact('empowerment'));
    }

    public function edit(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empowerments.edit', compact('empowerment'));
    }

    public function update(UpdateEmpowermentRequest $request, Empowerment $empowerment)
    {
        $empowerment->update($request->all());

        return to_route('admin.empowerments.index')->with('message', $empowerment->name.' Empowerment updated successfully');

    }

    public function destroy(Empowerment $empowerment)
    {
        abort_if(Gate::denies('empowerment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $empowerment->delete();

        return back()->with('message', $empowerment->name.' Empowerment deleted successfully');

    }
}
