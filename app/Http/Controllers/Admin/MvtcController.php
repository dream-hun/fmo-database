<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMvtcRequest;
use App\Http\Requests\Admin\UpdateMvtcRequest;
use App\Models\Mvtc;
use App\Models\Traits\CsvImportTrait;
use Gate;
use Symfony\Component\HttpFoundation\Response;

final class MvtcController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mvtc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mvtcs = Mvtc::all();

        return view('admin.mvtcs.index', compact('mvtcs'));
    }

    public function create()
    {
        abort_if(Gate::denies('mvtc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mvtcs.create');
    }

    public function store(StoreMvtcRequest $request)
    {
        $mvtc = Mvtc::create($request->all());

        return redirect()->route('admin.mvtcs.index');
    }

    public function edit(Mvtc $mvtc)
    {
        abort_if(Gate::denies('mvtc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mvtcs.edit', compact('mvtc'));
    }

    public function update(UpdateMvtcRequest $request, Mvtc $mvtc)
    {
        $mvtc->update($request->all());

        return redirect()->route('admin.mvtcs.index');
    }

    public function destroy(Mvtc $mvtc)
    {
        abort_if(Gate::denies('mvtc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mvtc->delete();

        return back();
    }
}
