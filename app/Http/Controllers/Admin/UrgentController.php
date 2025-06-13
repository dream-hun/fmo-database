<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUrgentRequest;
use App\Http\Requests\Admin\UpdateUrgentRequest;
use App\Models\Traits\CsvImport;
use App\Models\Urgent;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class UrgentController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('urgent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $urgents = Urgent::all();

        return view('admin.urgents.index', compact('urgents'));
    }

    public function create()
    {
        abort_if(Gate::denies('urgent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.urgents.create');
    }

    public function store(StoreUrgentRequest $request)
    {
        $urgent = Urgent::create($request->all());

        return to_route('admin.urgents.index')->with('message', $urgent->name.' Created Successfully');
    }

    public function edit(Urgent $urgent)
    {
        abort_if(Gate::denies('urgent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.urgents.edit', compact('urgent'));
    }

    public function update(UpdateUrgentRequest $request, Urgent $urgent)
    {
        $urgent->update($request->all());

        return to_route('admin.urgents.index')->with('message', $urgent->name.' Updated Successfully');
    }

    public function destroy(Urgent $urgent)
    {
        abort_if(Gate::denies('urgent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $urgent->delete();

        return back()->with('message', $urgent->name.' Deleted Successfully');
    }
}
