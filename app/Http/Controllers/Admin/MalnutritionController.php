<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMalnutritionRequest;
use App\Http\Requests\StoreMalnutritionRequest;
use App\Http\Requests\UpdateMalnutritionRequest;
use App\Models\Malnutrition;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class MalnutritionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('malnutrition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $malnutritions = Malnutrition::all();

        return view('admin.malnutritions.index', compact('malnutritions'));
    }

    public function create()
    {
        abort_if(Gate::denies('malnutrition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.malnutritions.create');
    }

    public function store(StoreMalnutritionRequest $request)
    {
        $malnutrition = Malnutrition::create($request->all());

        return redirect()->route('admin.malnutritions.index');
    }

    public function edit(Malnutrition $malnutrition)
    {
        abort_if(Gate::denies('malnutrition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.malnutritions.edit', compact('malnutrition'));
    }

    public function update(UpdateMalnutritionRequest $request, Malnutrition $malnutrition)
    {
        $malnutrition->update($request->all());

        return redirect()->route('admin.malnutritions.index');
    }

    public function destroy(Malnutrition $malnutrition)
    {
        abort_if(Gate::denies('malnutrition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $malnutrition->delete();

        return back();
    }

    public function massDestroy(MassDestroyMalnutritionRequest $request)
    {
        $malnutritions = Malnutrition::find(request('ids'));

        foreach ($malnutritions as $malnutrition) {
            $malnutrition->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
