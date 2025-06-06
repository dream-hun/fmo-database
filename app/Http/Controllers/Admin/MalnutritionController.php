<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMalnutritionRequest;
use App\Http\Requests\Admin\UpdateMalnutritionRequest;
use App\Models\Malnutrition;
use App\Models\Traits\CsvImportTrait;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class MalnutritionController extends Controller
{
    use CsvImportTrait;

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
}
