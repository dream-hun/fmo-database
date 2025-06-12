<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLivestockRequest;
use App\Http\Requests\Admin\UpdateLivestockRequest;
use App\Models\Livestock;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class LivestockController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('livestock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $livestocks = Livestock::all();

        return view('admin.livestocks.index', compact('livestocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('livestock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.livestocks.create');
    }

    public function store(StoreLivestockRequest $request)
    {
        $livestock = Livestock::create($request->validated());

        return redirect()->route('admin.livestocks.index');
    }

    public function edit(Livestock $livestock)
    {
        abort_if(Gate::denies('livestock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.livestocks.edit', compact('livestock'));
    }

    public function update(UpdateLivestockRequest $request, Livestock $livestock)
    {
        $livestock->update($request->validated());

        return redirect()->route('admin.livestocks.index');
    }

    public function show(Livestock $livestock)
    {
        abort_if(Gate::denies('livestock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.livestocks.show', compact('livestock'));
    }

    public function destroy(Livestock $livestock)
    {
        abort_if(Gate::denies('livestock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $livestock->delete();

        return back();
    }
}
