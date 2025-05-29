<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMusaRequest;
use App\Http\Requests\Admin\UpdateMusaRequest;
use App\Models\Musa;
use App\Models\Traits\CsvImportTrait;
use Gate;
use Symfony\Component\HttpFoundation\Response;

final class MusaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('musa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $musas = Musa::all();

        return view('admin.musas.index', compact('musas'));
    }

    public function create()
    {
        abort_if(Gate::denies('musa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.musas.create');
    }

    public function store(StoreMusaRequest $request)
    {
        $musa = Musa::create($request->all());

        return redirect()->route('admin.musas.index');
    }

    public function edit(Musa $musa)
    {
        abort_if(Gate::denies('musa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.musas.edit', compact('musa'));
    }

    public function update(UpdateMusaRequest $request, Musa $musa)
    {
        $musa->update($request->all());

        return redirect()->route('admin.musas.index');
    }

    public function destroy(Musa $musa)
    {
        abort_if(Gate::denies('musa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $musa->delete();

        return back();
    }
}
