<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEcdRequest;
use App\Http\Requests\Admin\UpdateEcdRequest;
use App\Models\Ecd;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class EcdController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('ecd_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ecds = Ecd::all();

        return view('admin.ecds.index', compact('ecds'));
    }

    public function create()
    {
        abort_if(Gate::denies('ecd_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ecds.create');
    }

    public function store(StoreEcdRequest $request)
    {
        $ecd = Ecd::create($request->all());

        return redirect()->route('admin.ecds.index');
    }

    public function edit(Ecd $ecd)
    {
        abort_if(Gate::denies('ecd_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ecds.edit', compact('ecd'));
    }

    public function update(UpdateEcdRequest $request, Ecd $ecd)
    {
        $ecd->update($request->all());

        return redirect()->route('admin.ecds.index');
    }

    public function destroy(Ecd $ecd)
    {
        abort_if(Gate::denies('ecd_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ecd->delete();

        return back();
    }
}
